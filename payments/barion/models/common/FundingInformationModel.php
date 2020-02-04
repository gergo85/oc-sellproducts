<?php namespace Indikator\SellProducts\Payments\Barion\Models\Common;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Payments\Barion\Models\BankCardModel;

class FundingInformationModel implements iBarionModel
{
    public $BankCard;
    public $AuthorizationCode;

    function __construct()
    {
        $this->BankCard = new BankCardModel();
        $this->AuthorizationCode = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->BankCard = new BankCardModel();
            $this->BankCard->fromJson(jget($json, 'BankCard'));
            $this->AuthorizationCode = jget($json, 'AuthorizationCode');
        }
    }
}