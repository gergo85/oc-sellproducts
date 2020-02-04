<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\BaseRequestModel;

class PaymentStateRequestModel extends BaseRequestModel
{
    public $PaymentId;

    function __construct($paymentId)
    {
        $this->PaymentId = $paymentId;
    }
}