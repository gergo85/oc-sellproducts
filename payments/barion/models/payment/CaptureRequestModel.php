<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\BaseRequestModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\TransactionToCaptureModel;

class CaptureRequestModel extends BaseRequestModel
{
    public $PaymentId;
    public $Transactions;

    function __construct($paymentId)
    {
        $this->PaymentId = $paymentId;
        $this->Transactions = array();
    }

    public function AddTransaction(TransactionToCaptureModel $transaction)
    {
        if ($this->Transactions == null) {
            $this->Transactions = array();
        }
        array_push($this->Transactions, $transaction);
    }

    public function AddTransactions($transactions)
    {
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                if ($transaction instanceof TransactionToCaptureModel) {
                    $this->AddTransaction($transaction);
                }
            }
        }
    }

}