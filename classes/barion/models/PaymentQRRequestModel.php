<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Models\BaseRequestModel;
use Indikator\SellProducts\Classes\Barion\Models\QRCodeSize;

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
