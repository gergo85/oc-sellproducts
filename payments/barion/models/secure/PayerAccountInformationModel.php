<?php namespace Indikator\SellProducts\Payments\Barion\Models\Secure;

use Indikator\SellProducts\Payments\Barion\Helpers\iBarionModel;

class PayerAccountInformationModel implements iBarionModel
{
    public $AccountId;
    public $AccountCreated;
    public $AccountCreationIndicator;
    public $AccountLastChanged;
    public $AccountChangeIndicator;
    public $PasswordLastChanged;
    public $PasswordChangeIndicator;
    public $PurchasesInTheLastSixMonths;
    public $ShippingAddressAdded;
    public $ShippingAddressUsageIndicator;
    public $PaymentMethodAdded;
    public $PaymentMethodIndicator;
    public $ProvisionAttempts;
    public $TransactionalActivityPerDay;
    public $TransactionalActivityPerYear;
    public $SuspiciousActivityIndicator;

    function __construct()
    {
        $this->AccountId = "";
        $this->AccountCreated = "";
        $this->AccountCreationIndicator = "";
        $this->AccountLastChanged = "";
        $this->AccountChangeIndicator = "";
        $this->PasswordLastChanged = "";
        $this->PasswordChangeIndicator = "";
        $this->PurchasesInTheLastSixMonths = "";
        $this->ShippingAddressAdded = "";
        $this->ShippingAddressUsageIndicator = "";
        $this->PaymentMethodAdded = "";
        $this->PaymentMethodIndicator = "";
        $this->ProvisionAttempts = "";
        $this->TransactionalActivityPerDay = "";
        $this->TransactionalActivityPerYear = "";
        $this->SuspiciousActivityIndicator = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            $this->AccountId = jget($json, 'AccountId');
            $this->AccountCreated = jget($json, 'AccountCreated');
            $this->AccountCreationIndicator = jget($json, 'AccountCreationIndicator');
            $this->AccountLastChanged = jget($json, 'AccountLastChanged');
            $this->AccountChangeIndicator = jget($json, 'AccountChangeIndicator');
            $this->PasswordLastChanged = jget($json, 'PasswordLastChanged');
            $this->PasswordChangeIndicator = jget($json, 'PasswordChangeIndicator');
            $this->PurchasesInTheLastSixMonths = jget($json, 'PurchasesInTheLastSixMonths');
            $this->ShippingAddressAdded = jget($json, 'ShippingAddressAdded');
            $this->ShippingAddressUsageIndicator = jget($json, 'ShippingAddressUsageIndicator');
            $this->PaymentMethodAdded = jget($json, 'PaymentMethodAdded');
            $this->PaymentMethodIndicator = jget($json, 'PaymentMethodIndicator');
            $this->ProvisionAttempts = jget($json, 'ProvisionAttempts');
            $this->TransactionalActivityPerDay = jget($json, 'TransactionalActivityPerDay');
            $this->TransactionalActivityPerYear = jget($json, 'TransactionalActivityPerYear');
            $this->SuspiciousActivityIndicator = jget($json, 'SuspiciousActivityIndicator');
        }
    }
}