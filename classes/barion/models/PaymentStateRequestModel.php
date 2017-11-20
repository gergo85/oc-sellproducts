<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Models\BaseRequestModel;

class PaymentStateRequestModel extends BaseRequestModel
{
    public $PaymentId;

    function __construct($paymentId)
    {
        $this->PaymentId = $paymentId;
    }
}
