<?php namespace Indikator\SellProducts\Payments\Barion\Models\Secure;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;

class PurchaseInformationModel implements iBarionModel
{
    public $DeliveryTimeframe;
    public $DeliveryEmailAddress;
    public $PreOrderDate;
    public $AvailabilityIndicator;
    public $ReOrderIndicator;
    public $RecurringExpiry;
    public $RecurringFrequency;
    public $ShippingAddressIndicator;
    public $GiftCardPurchase;
    public $PurchaseType;

    function __construct()
    {
        $this->DeliveryTimeframe = "";
        $this->DeliveryEmailAddress = "";
        $this->PreOrderDate = "";
        $this->AvailabilityIndicator = "";
        $this->ReOrderIndicator = "";
        $this->RecurringExpiry = "";
        $this->RecurringFrequency = "";
        $this->ShippingAddressIndicator = "";
        $this->GiftCardPurchase = "";
        $this->PurchaseType = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->DeliveryTimeframe = jget($json, 'DeliveryTimeframe');
            $this->DeliveryEmailAddress = jget($json, 'DeliveryEmailAddress');
            $this->PreOrderDate = jget($json, 'PreOrderDate');
            $this->AvailabilityIndicator = jget($json, 'AvailabilityIndicator');
            $this->ReOrderIndicator = jget($json, 'ReOrderIndicator');
            $this->RecurringExpiry = jget($json, 'RecurringExpiry');
            $this->RecurringFrequency = jget($json, 'RecurringFrequency');
            $this->ShippingAddressIndicator = jget($json, 'ShippingAddressIndicator');
            $this->GiftCardPurchase = jget($json, 'GiftCardPurchase');
            $this->PurchaseType = jget($json, 'PurchaseType');
        }
    }
}