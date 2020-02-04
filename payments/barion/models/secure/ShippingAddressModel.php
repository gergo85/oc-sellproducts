<?php namespace Indikator\SellProducts\Payments\Barion\Models\Secure;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;

class ShippingAddressModel implements iBarionModel
{
    public $Country;
    public $Region;
    public $City;
    public $Zip;
    public $Street;
    public $Street2;
    public $Street3;
    public $FullName;

    function __construct()
    {
        $this->Country = "";
        $this->Region = "";
        $this->City = "";
        $this->Zip = "";
        $this->Street = "";
        $this->Street2 = "";
        $this->Street3 = "";
        $this->FullName = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->Country = jget($json, 'Country');
            $this->Region = jget($json, 'Region');
            $this->City = jget($json, 'City');
            $this->Zip = jget($json, 'Zip');
            $this->Street = jget($json, 'Street');
            $this->Street2 = jget($json, 'Street2');
            $this->Street3 = jget($json, 'Street3');
            $this->FullName = jget($json, 'FullName');
        }
    }
}