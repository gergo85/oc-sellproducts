<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\BaseResponseModel;
use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\TransactionResponseModel;

class CancelAuthorizationResponseModel extends BaseResponseModel implements iBarionModel
{
    public $IsSuccessful;
    public $PaymentId;
    public $PaymentRequestId;
    public $Status;
    public $Transactions;

    function __construct()
    {
        parent::__construct();
        $this->IsSuccessful = false;
        $this->PaymentId = "";
        $this->PaymentRequestId = "";
        $this->Status = "";
        $this->Transactions = array();
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            parent::fromJson($json);

            $this->IsSuccessful = jget($json, 'IsSuccessful');
            $this->PaymentId = jget($json, 'PaymentId');
            $this->PaymentRequestId = jget($json, 'PaymentRequestId');
            $this->Status = jget($json, 'Status');

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