<?php namespace Indikator\SellProducts\Payments\Barion\Models\Refund;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;

class RefundedTransactionModel implements iBarionModel
{
    public $TransactionId;
    public $Total;
    public $POSTransactionId;
    public $Comment;
    public $Status;

    function __construct()
    {
        $this->TransactionId = "";
        $this->Total = 0;
        $this->POSTransactionId = "";
        $this->Comment = "";
        $this->Status = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->TransactionId = $json['TransactionId'];
            $this->Total = $json['Total'];
            $this->POSTransactionId = $json['POSTransactionId'];
            $this->Comment = $json['Comment'];
            $this->Status = $json['Status'];
        }
    }
}