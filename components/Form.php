<?php namespace Indikator\SellProducts\Components;

use Cms\Classes\ComponentBase;
use Indikator\SellProducts\Models\Category;
use Indikator\SellProducts\Models\Orders;
use Indikator\SellProducts\Models\Products;
use Indikator\SellProducts\Models\Settings;
use Indikator\SellProducts\Payments\Barion\BarionClient;
use Indikator\SellProducts\Payments\Barion\Models\Common\ItemModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PaymentTransactionModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PreparePaymentRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Secure\ShippingAddressModel;
use File;
use Lang;
use Config;
use Redirect;
use Validator;
use ValidationException;

class Form extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.sellproducts::lang.component.form.name',
            'description' => 'indikator.sellproducts::lang.component.form.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'category' => [
                'title'   => 'indikator.sellproducts::lang.form.category',
                'type'    => 'dropdown'
            ],
            'total' => [
                'title'   => 'indikator.sellproducts::lang.component.form.total',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'billing' => [
                'title'   => 'indikator.sellproducts::lang.component.form.billing',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'shipping' => [
                'title'   => 'indikator.sellproducts::lang.component.form.shipping',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'comment' => [
                'title'   => 'indikator.sellproducts::lang.component.form.comment',
                'default' => true,
                'type'    => 'checkbox'
            ]
        ];
    }

    public function getCategoryOptions()
    {
        $result = [];

        foreach (Category::orderBy('name', 'asc')->get()->all() as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }

    public function onRun()
    {
        // No product
        if (Products::where(['category' => $this->property('category'), 'status' => 1])->count() == 0) {
            $this->page['warning']  = true;
            $this->page['products'] = Lang::get('indikator.sellproducts::lang.component.form.warning');
        }

        // List products
        else {
            $this->page['warning']  = false;
            $this->page['category'] = $this->property('category');
            $this->page['products'] = Products::where(['category' => $this->property('category'), 'status' => 1])->get()->all();

            $category = Category::whereId($this->property('category'))->first();
            $payment  = '';

            foreach ($category->payment as $item) {
                if (!Settings::get($item['payment_type'].'_enable', false)) {
                    continue;
                }

                $checked = ($payment == '') ? ' checked' : '';

                $payment .= '<input type="radio" name="payment" value="'.$item['payment_type'].'" data-redirect="'.Settings::get($item['payment_type'].'_redirect', false).'" class="sellproducts_payment"'.$checked.'> '.Settings::get($item['payment_type'].'_name', false);
                if ($item['payment_comment'] != '') {
                    $payment .= ' ('.$item['payment_comment'].')';
                }
                $payment .= '<br>';
            }

            $this->page['category'] = $category;
            $this->page['payment']  = $payment;
        }

        // Translate form
        $this->page['form'] = [
            'personal'   => Lang::get('indikator.sellproducts::lang.component.form.personal'),
            'first_name' => Lang::get('indikator.sellproducts::lang.form.first_name'),
            'last_name'  => Lang::get('indikator.sellproducts::lang.form.last_name'),
            'email'      => Lang::get('indikator.sellproducts::lang.form.email'),
            'phone'      => Lang::get('indikator.sellproducts::lang.form.phone'),
            'billing'    => Lang::get('indikator.sellproducts::lang.form.billing'),
            'shipping'   => Lang::get('indikator.sellproducts::lang.form.shipping'),
            'name'       => Lang::get('indikator.sellproducts::lang.form.name'),
            'city'       => Lang::get('indikator.sellproducts::lang.form.city'),
            'zipcode'    => Lang::get('indikator.sellproducts::lang.form.zipcode'),
            'address'    => Lang::get('indikator.sellproducts::lang.form.address'),
            'comment'    => Lang::get('indikator.sellproducts::lang.form.comment'),
            'unit'       => Lang::get('indikator.sellproducts::lang.form.unit_piece'),
            'items'      => Lang::get('indikator.sellproducts::lang.component.form.items'),
            'total'      => Lang::get('indikator.sellproducts::lang.component.form.total'),
            'payment'    => Lang::get('indikator.sellproducts::lang.component.form.payment'),
            'submit'     => Lang::get('indikator.sellproducts::lang.component.form.submit')
        ];

        // Display options
        $this->page['total']    = $this->property('total');
        $this->page['billing']  = $this->property('billing');
        $this->page['shipping'] = $this->property('shipping');
        $this->page['comment']  = $this->property('comment');
    }

    public function onSellProducts()
    {
        // Form data
        $data = post();

        // Define roles
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required'
        ];

        // Billing data
        if ($this->property('billing')) {
            $more_rules = [
                'billing_name'    => 'required',
                'billing_zipcode' => 'required',
                'billing_city'    => 'required',
                'billing_address' => 'required'
            ];

            $rules = array_merge($rules, $more_rules);
        }

        // Shipping data
        if ($this->property('shipping')) {
            $more_rules = [
                'shipping_name'    => 'required',
                'shipping_zipcode' => 'required',
                'shipping_city'    => 'required',
                'shipping_address' => 'required'
            ];

            $rules = array_merge($rules, $more_rules);
        }

        // Validation check
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $products = [];
        $total    = 0;

        // Products
        foreach ($data['quantity'] as $key => $value) {
            if ($value > 0 && Products::where(['id' => $data['product'][$key], 'status' => 1])->count() == 1) {
                // Product
                $product = Products::whereId($data['product'][$key])->first();
                if ($product->status == 1) {
                    // Get price 
                    $price = ($product->sale_price > 0) ? $product->sale_price : $product->price;

                    // Check quantity
                    if ($value > $product->quantity) {
                        $value = $product->quantity;
                    }

                    // Add product
                    $products[] = [
                        'product'  => $data['product'][$key],
                        'quantity' => $value,
                        'price'    => $price * $value
                    ];

                    // Increase total
                    $total += $price * $value;

                    // Change data
                    Products::whereId($data['product'][$key])->update([
                        'quantity' => $product->quantity - $value,
                        'orders'   => $product->orders + $value
                    ]);

                    // Get category
                    if (!isset($category) && Category::where(['id' => $product->category, 'status' => 1])->count() == 1) {
                        $category = Category::where(['id' => $product->category, 'status' => 1])->first();
                    }
                }
            }
        }

        // No item selected
        if (count($products) == 0) {
            return;
        }

        // Check data
        if (!isset($data['user']) || !is_numeric($data['user'])) {
            $data['user'] = 0;
        }
        if (!isset($data['name'])) {
            $data['name'] = '';
        }
        if (!isset($data['city'])) {
            $data['city'] = '';
        }
        if (!isset($data['zipcode'])) {
            $data['zipcode'] = '';
        }
        if (!isset($data['address'])) {
            $data['address'] = '';
        }
        if (!isset($data['comment'])) {
            $data['comment'] = '';
        }

        // Add to database
        $orderId = Orders::insertGetId([
            'user'             => $data['user'],
            'products'         => json_encode($products),
            'first_name'       => $data['first_name'],
            'last_name'        => $data['last_name'],
            'email'            => $data['email'],
            'phone'            => $data['phone'],
            'billing_name'     => $data['billing_name'],
            'billing_zipcode'  => $data['billing_zipcode'],
            'billing_city'     => $data['billing_city'],
            'billing_address'  => $data['billing_address'],
            'shipping_name'    => $data['shipping_name'],
            'shipping_zipcode' => $data['shipping_zipcode'],
            'shipping_city'    => $data['shipping_city'],
            'shipping_address' => $data['shipping_address'],
            'comment'          => $data['comment'],
            'payment'          => $data['payment'],
            'total'            => $total,
            'category'         => $category->id,
            'status'           => 3,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ]);

        // Barion payment
        if ($data['payment'] == 'barion' && Settings::get('barion_enable', false)) {

            // Main file
            require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/indikator/sellproducts/payments/barion/BarionClient.php';

            // Variables
            $myPosKey = Settings::get('barion_key', false);
            $envType  = Settings::get('barion_mode', false);
 
            // Barion Client
            $BC = new BarionClient($myPosKey, 2, $envType);

            // Create the transaction
            $trans = new PaymentTransactionModel();
            $trans->POSTransactionId = 'TRANS-'.time();
            $trans->Payee   = Settings::get('barion_email', false);
            $trans->Total   = 0;
            $trans->Comment = $data['comment'];

            // Create one or more items
            foreach ($products as $product) {
                // Product
                $details = Products::whereId($product['product'])->first();

                // Check
                if ($details->summary == '') {
                    $details->summary = '-';
                }

                // Item
                $item = new ItemModel();
                $item->Name        = $details->name;
                $item->Description = $details->summary;
                $item->Quantity    = $product['quantity'];
                $item->Unit        = $details->unit;
                $item->UnitPrice   = $details->price;
                $item->ItemTotal   = $details->price * $product['quantity'];
                $item->SKU         = 'ITEM-'.$details->id;

                $trans->Total += $item->ItemTotal;
                $trans->AddItem($item);
            }

            // Create the shipping address
            $shippingAddress = new ShippingAddressModel();
            $shippingAddress->Country  = 'HU';
            $shippingAddress->Region   = null;
            $shippingAddress->City     = $data['city'];
            $shippingAddress->Zip      = $data['zipcode'];
            $shippingAddress->Street   = $data['address'];
            $shippingAddress->Street2  = '';
            $shippingAddress->Street3  = '';
            $shippingAddress->FullName = $data['first_name'].' '.$data['last_name'];

            // Create the payment request
            $psr = new PreparePaymentRequestModel();
            $psr->GuestCheckout    = true;
            $psr->PaymentType      = Settings::get('barion_type', false);
            $psr->FundingSources   = ['All'];
            $psr->PaymentRequestId = 'PAYMENT-'.time();
            $psr->PayerHint        = $data['email'];
            $psr->Locale           = $category->locale;
            $psr->Currency         = $category->currency;
            $psr->OrderNumber      = 'ORDER-'.Orders::count();
            $psr->ShippingAddress  = $shippingAddress;
            $psr->RedirectUrl      = Config::get('app.url').Settings::get('barion_redirect', false);
            $psr->CallbackUrl      = Config::get('app.url').Settings::get('barion_callback', false);
            $psr->AddTransaction($trans);

            // Send the request
            $myPayment = $BC->PreparePayment($psr);

            // Request is successful
            if ($myPayment->RequestSuccessful === true) {
                // URL type
                $redirectUrl = ($envType == 'prod') ? BARION_WEB_URL_PROD : BARION_WEB_URL_TEST;

                // Redirect
                return Redirect::to($redirectUrl.'?id='.$myPayment->PaymentId);
            }
        }

        // Transfer payment
        else if ($data['payment'] == 'transfer' && Settings::get('transfer_enable', false)) {
            // Redirect
            return Redirect::to(Settings::get('transfer_redirect', false));
        }

        // Cash payment
        else if ($data['payment'] == 'cash' && Settings::get('cash_enable', false)) {
            // Redirect
            return Redirect::to(Settings::get('cash_redirect', false));
        }
    }
}
