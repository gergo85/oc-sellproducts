<?php namespace Indikator\SellProducts\Classes\Barion\Models;

use Indikator\SellProducts\Classes\Barion\Helpers\iBarionModel;
use Indikator\SellProducts\Classes\Barion\Models\BaseResponseModel;
use Indikator\SellProducts\Classes\Barion\Models\FundingInformationModel;
use Indikator\SellProducts\Classes\Barion\Models\TransactionDetailModel;

class PaymentStateResponseModel extends BaseResponseModel implements iBarionModel
{
    public $PaymentId;
    public $PaymentRequestId;
    public $OrderNumber;
    public $POSId;
    public $POSName;
    public $POSOwnerEmail;
    public $Status;
    public $PaymentType;
    public $FundingSource;
    public $FundingInformation;
    public $AllowedFundingSources;
    public $GuestCheckout;
    public $CreatedAt;
    public $ValidUntil;
    public $CompletedAt;
    public $ReservedUntil;
    public $Total;
    public $Currency;
    public $Transactions;
    public $RecurrenceResult;
    public $SuggestedLocale;
    public $FraudRiskScore;
    public $RedirectUrl;
    public $CallbackUrl;

    function __construct()
    {
        parent::__construct();
        $this->PaymentId = "";
        $this->PaymentRequestId = "";
        $this->OrderNumber = "";
        $this->POSId = "";
        $this->POSName = "";
        $this->POSOwnerEmail = "";
        $this->Status = "";
        $this->PaymentType = "";
        $this->FundingSource = "";
        $this->FundingInformation = new FundingInformationModel();
        $this->AllowedFundingSources = "";
        $this->GuestCheckout = "";
        $this->CreatedAt = "";
        $this->ValidUntil = "";
        $this->CompletedAt = "";
        $this->ReservedUntil = "";
        $this->Total = 0;
        $this->Currency = "";
        $this->Transactions = array();
        $this->RecurrenceResult = "";
        $this->SuggestedLocale ="";
        $this->FraudRiskScore = 0;
        $this->RedirectUrl = "";
        $this->CallbackUrl = "";
    }

    public function fromJson($json)
    {
        if (!empty($json)) {
            parent::fromJson($json);

            $this->PaymentId = jget($json, 'PaymentId');
            $this->PaymentRequestId = jget($json, 'PaymentRequestId');
            $this->OrderNumber = jget($json, 'OrderNumber');
            $this->POSId = jget($json, 'POSId');
            $this->POSName = jget($json, 'POSName');
            $this->POSOwnerEmail = jget($json, 'POSOwnerEmail');
            $this->Status = jget($json, 'Status');
            $this->PaymentType = jget($json, 'PaymentType');
            $this->FundingSource = jget($json, 'FundingSource');
            if(!empty($json['FundingInformation'])) {
                $this->FundingInformation = new FundingInformationModel();
                $this->FundingInformation->fromJson(jget($json, 'FundingInformation'));
            }
            $this->AllowedFundingSources = jget($json, 'AllowedFundingSources');
            $this->GuestCheckout = jget($json, 'GuestCheckout');
            $this->CreatedAt = jget($json, 'CreatedAt');
            $this->ValidUntil = jget($json, 'ValidUntil');
            $this->CompletedAt = jget($json, 'CompletedAt');
            $this->ReservedUntil = jget($json, 'ReservedUntil');
            $this->Total = jget($json, 'Total');
            $this->Currency = jget($json, 'Currency');
            $this->RecurrenceResult = jget($json, 'RecurrenceResult');
            $this->SuggestedLocale = jget($json, 'SuggestedLocale');
            $this->FraudRiskScore = jget($json, 'FraudRiskScore');
            $this->RedirectUrl = jget($json, 'RedirectUrl');
            $this->CallbackUrl = jget($json, 'CallbackUrl');

            $this->Transactions = array();

            if (!empty($json['Transactions'])) {
                foreach ($json['Transactions'] as $key => $value) {
                    $tr = new TransactionDetailModel();
                    $tr->fromJson($value);
                    array_push($this->Transactions, $tr);
                }
            }
        }
    }
}
