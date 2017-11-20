<?php namespace Indikator\SellProducts\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\SellProducts\Models\Orders;

class Reports extends Controller
{
    public $requiredPermissions = ['indikator.sellproducts.reports'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.SellProducts', 'sellproducts', 'reports');
    }

    public function index()
    {
        $this->pageTitle = 'indikator.sellproducts::lang.menu.reports';

        $this->addCss('/plugins/indikator/sellproducts/assets/css/statistics.css');

        $this->vars['count'] = Orders::count();
        $this->vars['sales'] = $this->getSales();
    }

    public function getSales()
    {
        // Statistics
        $stat = '';

        // Last 20
        for ($i = 0; $i < 20; $i++) {
            if ($i == 0) {
                $date = time();
            }
            else if ($i == 1) {
                $date = strtotime('-1 day');
            }
            else {
                $date = strtotime('-'.$i.' days');
            }
                
            $count = Orders::where('created_at', '>=', date('Y-m-d 00:00:00', $date))->where('created_at', '<=', date('Y-m-d 23:59:59', $date))->count();

            $stat .= '['.$date.'000,'.$count.'],';
        }

        // Result
        return substr($stat, 0, -1);
    }
}
