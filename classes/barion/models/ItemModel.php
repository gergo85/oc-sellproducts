<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Classes\Barion\Helpers\BarionHelper;

class ItemModel implements iBarionModel
{
    public $Name;
    public $Description;
    public $Quantity;
    public $Unit;
    public $UnitPrice;
    public $ItemTotal;
    public $SKU;

    function __construct()
    {
        $this->Name = "";
        $this->Description = "";
        $this->Quantity = 0;
        $this->Unit = "";
        $this->UnitPrice = 0;
        $this->ItemTotal = 0;
        $this->SKU = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->Name = BarionHelper::jget($json, 'Name');
            $this->Description = BarionHelper::jget($json, 'Description');
            $this->Quantity = BarionHelper::jget($json, 'Quantity');
            $this->Unit = BarionHelper::jget($json, 'Unit');
            $this->UnitPrice = BarionHelper::jget($json, 'UnitPrice');
            $this->ItemTotal = BarionHelper::jget($json, 'ItemTotal');
            $this->SKU = BarionHelper::jget($json, 'SKU');
        }
    }
}
