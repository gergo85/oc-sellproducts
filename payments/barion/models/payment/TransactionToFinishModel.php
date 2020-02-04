<?php namespace Indikator\SellProducts\Payments\Barion\Models\Payment;

use Indikator\SellProducts\Payments\Barion\Models\Common\ItemModel;
use Indikator\SellProducts\Payments\Barion\Models\Payment\PayeeTransactionToFinishModel;

class TransactionToFinishModel
{
    public $TransactionId;
    public $Total;
    public $PayeeTransactions;
    public $Items;
    public $Comment;

    function __construct()
    {
        $this->TransactionId = "";
        $this->Total = 0;
        $this->PayeeTransactions = array();
        $this->Comment = "";
        $this->Items = array();
    }

    public function AddItem(ItemModel $item)
    {
        if ($this->Items == null) {
            $this->Items = array();
        }
        array_push($this->Items, $item);
    }

    public function AddItems($items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                if ($item instanceof ItemModel) {
                    $this->AddItem($item);
                }
            }
        }
    }
    
    public function AddPayeeTransaction(PayeeTransactionToFinishModel $model)
    {
        if ($this->PayeeTransactions == null) {
            $this->PayeeTransactions = array();
        }
        array_push($this->PayeeTransactions, $model);
    }

    public function AddPayeeTransactions($transactions)
    {
        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                if ($transaction instanceof PayeeTransactionToFinishModel) {
                    $this->AddPayeeTransaction($transaction);
                }
            }
        }
    }
}