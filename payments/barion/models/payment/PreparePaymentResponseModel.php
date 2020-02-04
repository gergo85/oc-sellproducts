<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\BaseResponseModel;
use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Payments\Barion\Helpers\BarionHelper;
use Indikator\SellProducts\Payments\Barion\Models\Payment\TransactionResponseModel;

class PreparePaymentResponseModel extends BaseResponseModel implements iBarionModel
{
    public $PaymentId;
    public $PaymentRequestId;
    public $Status;
    public $Transactions;
    public $QRUrl;
    public $RecurrenceResult;
    public $PaymentRedirectUrl;

    function __construct()
    {
        parent::__construct();
        $this->PaymentId = "";
        $this->PaymentRequestId = "";
        $this->Status = "";
        $this->QRUrl = "";
        $this->RecurrenceResult = "";
        $this->PaymentRedirectUrl = "";
        $this->Transactions = array();
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            parent::fromJson($json);
            $this->PaymentId = BarionHelper::jget($json, 'PaymentId');
            $this->PaymentRequestId = BarionHelper::jget($json, 'PaymentRequestId');
            $this->Status = BarionHelper::jget($json, 'Status');
            $this->QRUrl = BarionHelper::jget($json, 'QRUrl');
            $this->RecurrenceResult = BarionHelper::jget($json, 'RecurrenceResult');
            $this->Transactions = array();

            if (!empty($json['Transactions'])) {
                foreach ($json['Transactions'] as $key => $value) {
                    $tr = new TransactionResponseModel();
                    $tr->fromJson($value);
                    array_push($this->Transactions, $tr);
                }
            }

        }
    }
}