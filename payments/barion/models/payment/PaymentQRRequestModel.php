<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\BaseRequestModel;

class PaymentQRRequestModel extends BaseRequestModel
{
    public $UserName;
    public $Password;
    public $PaymentId;
    public $Size;

    function __construct($paymentId)
    {
        $this->PaymentId = $paymentId;
        $this->Size = QRCodeSize::Normal;
    }
}