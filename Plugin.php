<?php namespace Indikator\SellProducts;

use System\Classes\PluginBase;
use Backend;
use Lang;
use Indikator\SellProducts\Models\Orders;
use Indikator\SellProducts\Models\Products;
use Indikator\SellProducts\Controllers\Orders as OrdersControllers;
use Indikator\SellProducts\Controllers\Products as ProductsControllers;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.sellproducts::lang.plugin.name',
            'description' => 'indikator.sellproducts::lang.plugin.description',
            'author'      => 'indikator.sellproducts::lang.plugin.author',
            'icon'        => 'icon-shopping-bag',
            'homepage'    => 'https://github.com/gergo85/oc-sellproducts'
        ];
    }

    public function registerNavigation()
    {
        return [
            'sellproducts' => [
                'label'       => 'indikator.sellproducts::lang.plugin.name',
                'url'         => Backend::url('indikator/sellproducts/orders'),
                'icon'        => 'icon-shopping-bag',
                'iconSvg'     => 'plugins/indikator/sellproducts/assets/images/sellproducts-icon.svg', 
                'permissions' => ['indikator.sellproducts.*'],
                'order'       => 330,

                'sideMenu' => [
                    'orders' => [
                        'label'       => 'indikator.sellproducts::lang.menu.orders',
                        'url'         => Backend::url('indikator/sellproducts/orders'),
                        'icon'        => 'icon-shopping-cart',
                        'permissions' => ['indikator.sellproducts.orders'],
                        'order'       => 100
                    ],
                    'reports' => [
                        'label'       => 'indikator.sellproducts::lang.menu.reports',
                        'url'         => Backend::url('indikator/sellproducts/reports'),
                        'icon'        => 'icon-area-chart',
                        'permissions' => ['indikator.sellproducts.reports'],
                        'order'       => 200
                    ],
                    'products' => [
                        'label'       => 'indikator.sellproducts::lang.menu.products',
                        'url'         => Backend::url('indikator/sellproducts/products'),
                        'icon'        => 'icon-cubes',
                        'permissions' => ['indikator.sellproducts.products'],
                        'order'       => 300
                    ],
                    'category' => [
                        'label'       => 'indikator.sellproducts::lang.menu.category',
                        'url'         => Backend::url('indikator/sellproducts/category'),
                        'icon'        => 'icon-tags',
                        'permissions' => ['indikator.sellproducts.category'],
                        'order'       => 400
                    ],
                    'settings' => [
                        'label'       => 'indikator.sellproducts::lang.menu.settings',
                        'url'         => Backend::url('system/settings/update/indikator/sellproducts/settings'),
                        'icon'        => 'icon-cogs',
                        'permissions' => ['indikator.sellproducts.settings'],
                        'order'       => 500
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'indikator.sellproducts::lang.settings.label',
                'description' => 'indikator.sellproducts::lang.settings.description',
                'icon'        => 'icon-shopping-bag',
                'class'       => 'Indikator\SellProducts\Models\Settings',
                'category'    => 'system::lang.system.categories.cms',
                'permissions' => ['indikator.sellproducts.settings']
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Indikator\SellProducts\Components\Form' => 'form',
            'Indikator\SellProducts\Components\Logo' => 'logo'
        ];
    }

    public function registerPermissions()
    {
        return [
            'indikator.sellproducts.orders' => [
                'tab'   => 'indikator.sellproducts::lang.plugin.name',
                'label' => 'indikator.sellproducts::lang.permission.orders',
                'order' => 100,
                'roles' => ['publisher']
            ],
            'indikator.sellproducts.reports' => [
                'tab'   => 'indikator.sellproducts::lang.plugin.name',
                'label' => 'indikator.sellproducts::lang.permission.reports',
                'order' => 200,
                'roles' => ['publisher']
            ],
            'indikator.sellproducts.products' => [
                'tab'   => 'indikator.sellproducts::lang.plugin.name',
                'label' => 'indikator.sellproducts::lang.permission.products',
                'order' => 300,
                'roles' => ['publisher']
            ],
            'indikator.sellproducts.category' => [
                'tab'   => 'indikator.sellproducts::lang.plugin.name',
                'label' => 'indikator.sellproducts::lang.permission.category',
                'order' => 400,
                'roles' => ['publisher']
            ],
            'indikator.sellproducts.settings' => [
                'tab'   => 'indikator.sellproducts::lang.plugin.name',
                'label' => 'indikator.sellproducts::lang.permission.settings',
                'order' => 500,
                'roles' => ['publisher']
            ]
        ];
    }

    public function registerListColumnTypes()
    {
        return [
            'sellproducts_status' => function($value) {
                $text = [
                    1 => 'active',
                    2 => 'inactive',
                    3 => 'pending',
                    4 => 'paid',
                    5 => 'closed',
                    6 => 'cancelled'
                ];

                $class = [
                    1 => 'text-info',
                    2 => 'text-danger',
                    3 => 'text-warning',
                    4 => 'text-info',
                    5 => 'text-success',
                    6 => 'text-danger'
                ];

                return '<span class="oc-icon-circle '.$class[$value].'">'.Lang::get('indikator.sellproducts::lang.form.status_'.$text[$value]).'</span>';
            }
        ];
    }

    public function boot()
    {
        OrdersControllers::extendListColumns(function($list, $model)
        {
            if (!$model instanceof Orders) {
                return;
            }

            if (Orders::where('comment', '!=', '')->count() == 0) {
                $list->removeColumn('comment');
            }
        });

        ProductsControllers::extendListColumns(function($list, $model)
        {
            if (!$model instanceof Products) {
                return;
            }

            if (Products::where('sale_price', '!=', '')->count() == 0) {
                $list->removeColumn('sale_price');
            }
        });

        ProductsControllers::extendListFilterScopes(function($filter)
        {
            if (Products::where('sale_price', '!=', '')->count() == 0) {
                $filter->removeScope('sale_price');
            }
        });
    }
}
