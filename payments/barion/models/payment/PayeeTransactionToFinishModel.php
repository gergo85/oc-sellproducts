<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

class PayeeTransactionToFinishModel
{
    public $TransactionId;
    public $Total;
    public $Comment;

    function __construct()
    {
        $this->TransactionId = "";
        $this->Total = 0;
        $this->Comment = "";
    }
}
