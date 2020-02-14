<?php namespace Indikator\SellProducts\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\SellProducts\Models\Orders as Item;
use Flash;
use Lang;

class Orders extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['indikator.sellproducts.orders'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.SellProducts', 'sellproducts', 'orders');
    }

    public function onPending()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 3)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 3]);
            }

            Flash::success(Lang::get('indikator.sellproducts::lang.flash.pending'));
        }

        return $this->listRefresh();
    }

    public function onPaid()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 4)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 4]);
            }

            Flash::success(Lang::get('indikator.sellproducts::lang.flash.paid'));
        }

        return $this->listRefresh();
    }

    public function onClosed()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 5)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 5]);
            }

            Flash::success(Lang::get('indikator.sellproducts::lang.flash.closed'));
        }

        return $this->listRefresh();
    }

    public function onCancelled()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 6)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 6]);
            }

            Flash::success(Lang::get('indikator.sellproducts::lang.flash.cancelled'));
        }

        return $this->listRefresh();
    }
}
