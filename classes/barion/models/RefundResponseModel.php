<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Classes\Barion\Models\BaseResponseModel;
use Indikator\SellProducts\Classes\Barion\Models\RefundedTransactionModel;

class RefundResponseModel extends BaseResponseModel implements iBarionModel
{
    public $PaymentId;
    public $RefundedTransactions;

    function __construct()
    {
        parent::__construct();
        $this->PaymentId = "";
        $this->RefundedTransactions = array();
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            parent::fromJson($json);

            $this->PaymentId = jget($json, 'PaymentId');
            $this->RefundedTransactions = array();

            if (!empty($json['RefundedTransactions'])) {
                foreach ($json['RefundedTransactions'] as $key => $value) {
                    $tr = new RefundedTransactionModel();
                    $tr->fromJson($value);
                    array_push($this->RefundedTransactions, $tr);
                }
            }
        }
    }
}
