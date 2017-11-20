<?php namespace Indikator\SellProducts\Components;

use Cms\Classes\ComponentBase;
use Indikator\SellProducts\Models\Category;
use Indikator\SellProducts\Models\Orders;
use Indikator\SellProducts\Models\Products;
use Indikator\SellProducts\Models\Settings;
use Indikator\SellProducts\Classes\Barion\BarionClient;
use Indikator\SellProducts\Classes\Barion\Models\ItemModel;
use Indikator\SellProducts\Classes\Barion\Models\PaymentTransactionModel;
use Indikator\SellProducts\Classes\Barion\Models\PreparePaymentRequestModel;
use File;
use Lang;
use Redirect;
use Validator;
use ValidationException;

class Form extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.sellproducts::lang.component.name',
            'description' => 'indikator.sellproducts::lang.component.description'
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
                'title'   => 'indikator.sellproducts::lang.component.total',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'billing' => [
                'title'   => 'indikator.sellproducts::lang.component.billing',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'comment' => [
                'title'   => 'indikator.sellproducts::lang.component.comment',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'barion' => [
                'title'   => 'indikator.sellproducts::lang.component.barion',
                'default' => false,
                'type'    => 'checkbox'
            ]
        ];
    }

    public function getCategoryOptions()
    {
        $result = [];

        foreach (Category::orderBy('name', 'asc')->get() as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }

    public function onRun()
    {
        // No product
        if (Products::where(['category' => $this->property('category'), 'status' => 1])->count() == 0) {
            $this->page['warning']  = true;
            $this->page['products'] = Lang::get('indikator.sellproducts::lang.component.warning');
        }

        // List products
        else {
            $this->page['warning']  = false;
            $this->page['products'] = Products::where(['category' => $this->property('category'), 'status' => 1])->get();

            $category = Category::where('id', $this->property('category'))->first();
            $payment = '';

            foreach ($category->payment as $item) {
                if (!Settings::get($item['payment_type'].'_enable', false)) {
                    continue;
                }

                if ($payment == '') {
                    $checked = ' checked';
                }
                else {
                    $checked = '';
                }

                $payment .= '<input type="radio" name="payment" value="'.$item['payment_type'].'" data-redirect="'.Settings::get($item['payment_type'].'_redirect', false).'" class="sellproducts_payment"'.$checked.'> '.Settings::get($item['payment_type'].'_name', false);
                if ($item['payment_text'] != '') {
                    $payment .= ' ('.$item['payment_text'].')';
                }
                $payment .= '<br>';
            }

            $this->page['category'] = $category;
            $this->page['payment']  = $payment;
        }

        // Translate form
        $this->page['form'] = [
            'personal'   => Lang::get('indikator.sellproducts::lang.component.personal'),
            'first_name' => Lang::get('indikator.sellproducts::lang.form.first_name'),
            'last_name'  => Lang::get('indikator.sellproducts::lang.form.last_name'),
            'email'      => Lang::get('indikator.sellproducts::lang.form.email'),
            'phone'      => Lang::get('indikator.sellproducts::lang.form.phone'),
            'name'       => Lang::get('indikator.sellproducts::lang.form.name'),
            'city'       => Lang::get('indikator.sellproducts::lang.form.city'),
            'zipcode'    => Lang::get('indikator.sellproducts::lang.form.zipcode'),
            'address'    => Lang::get('indikator.sellproducts::lang.form.address'),
            'comment'    => Lang::get('indikator.sellproducts::lang.form.comment'),
            'items'      => Lang::get('indikator.sellproducts::lang.component.items'),
            'total'      => Lang::get('indikator.sellproducts::lang.component.total'),
            'payment'    => Lang::get('indikator.sellproducts::lang.component.payment'),
            'submit'     => Lang::get('indikator.sellproducts::lang.component.submit')
        ];

        // Display options
        $this->page['total']   = $this->property('total');
        $this->page['billing'] = $this->property('billing');
        $this->page['comment'] = $this->property('comment');
        $this->page['barion']  = $this->property('barion');
    }

    public function onSellProducts()
    {
        // Form data
        $data = post();

        // Define roles
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required'
        ];

        // Billing information
        if ($this->property('billing')) {
            $rules .= [
                'name'    => 'required',
                'city'    => 'required',
                'zipcode' => 'required',
                'address' => 'required'
            ];
        }

        // Validation check
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        // Products
        $products = [];
        foreach ($data['quantity'] as $key => $value) {
            if ($value > 0) {
                $products[] = [
                    'product'  => $data['product'][$key],
                    'quantity' => $value
                ];
            }
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
        \Indikator\SellProducts\Models\Orders::insertGetId([
            'user'       => $data['user'],
            'products'   => json_encode($products),
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'name'       => $data['name'],
            'city'       => $data['city'],
            'zipcode'    => $data['zipcode'],
            'address'    => $data['address'],
            'comment'    => $data['comment'],
            'payment'    => $data['payment'],
            'status'     => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Barion payment
        if ($data['payment'] == 'barion' && Settings::get('barion_enable', false)) {
            // Main file
            require_once $_SERVER['DOCUMENT_ROOT'].'/plugins/indikator/sellproducts/classes/barion/BarionClient.php';

            // Settings
            $myPosKey    = Settings::get('barion_key', false);
            $apiVersion  = 2;
            $environment = Settings::get('barion_mode', false);

            // Barion Client
            $BC = new BarionClient($myPosKey, $apiVersion, $environment);

            // Transaction
            $trans = new PaymentTransactionModel();
            $trans->POSTransactionId = 'TRANS-'.time();
            $trans->Payee = Settings::get('barion_email', false);
            $trans->Total = 0;
            $trans->Currency = Settings::get('barion_currency', false);
            $trans->Comment = '';

            // Products
            foreach ($products as $product) {
                // Product
                $details = Products::where('id', $product['product'])->first();

                // Check
                if ($details->summary == '') {
                    $details->summary = '-';
                }

                // Item
                $item = new ItemModel();
                $item->Name = $details->name;
                $item->Description = $details->summary;
                $item->Quantity = $product['quantity'];
                $item->Unit = 'piece';
                $item->UnitPrice = $details->price;
                $item->ItemTotal = $details->price * $product['quantity'];
                $item->SKU = 'ITEM-'.$details->id;

                $trans->Total += $item->ItemTotal;
                $trans->AddItem($item);
            }

            // Prepare
            $ppr = new PreparePaymentRequestModel();
            $ppr->GuestCheckout = true;
            $ppr->PaymentType = 'Immediate';
            $ppr->FundingSources = ['All'];
            $ppr->PaymentRequestId = 'PAYMENT-'.time();
            $ppr->PayerHint = $data['email'];
            $ppr->Locale = Settings::get('barion_locale', false);
            $ppr->OrderNumber = 'ORDER-'.Orders::count();
            $ppr->Currency = Settings::get('barion_currency', false);
            $ppr->ShippingAddress = $data['zipcode'].' '.$data['address'];
            $ppr->RedirectUrl = Settings::get('barion_redirect', false);
            $ppr->CallbackUrl = Settings::get('barion_callback', false);
            $ppr->AddTransaction($trans);

            // Payment
            $myPayment = $BC->PreparePayment($ppr);

            // URL type
            if ($environment == 'prod') {
                $redirectUrl = BARION_WEB_URL_PROD;
            }
            else {
                $redirectUrl = BARION_WEB_URL_TEST;
            }

            // Redirect
            return Redirect::to($redirectUrl.'?id='.$myPayment->PaymentId);
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
