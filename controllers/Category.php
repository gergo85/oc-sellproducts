<?php namespace Indikator\SellProducts\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\SellProducts\Models\Category as Item;
use Indikator\SellProducts\Models\Products;
use Flash;
use Lang;

class Category extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController' 
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['indikator.sellproducts.category'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.SellProducts', 'sellproducts', 'category');
    }

    public function onActivate()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', 2)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 1]);
            }

            Flash::success(Lang::get('indikator.popup::lang.flash.activate'));
        }

        return $this->listRefresh();
    }

    public function onDeactivate()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', 1)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 2]);
            }

            Flash::success(Lang::get('indikator.popup::lang.flash.deactivate'));
        }

        return $this->listRefresh();
    }

    public function onRemove()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::whereId($itemId)) {
                    continue;
                }

                if (Products::where('category', $itemId) == 0) {
                    $item->delete();
                }
            }

            Flash::success(Lang::get('indikator.popup::lang.flash.remove'));
        }

        return $this->listRefresh();
    }
}
