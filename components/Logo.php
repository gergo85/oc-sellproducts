<?php namespace Indikator\SellProducts\Components;

use Cms\Classes\ComponentBase;

class Logo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.sellproducts::lang.component.logo.name',
            'description' => 'indikator.sellproducts::lang.component.logo.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'barion' => [
                'title'   => 'indikator.sellproducts::lang.component.barion',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'barion_size' => [
                'title'   => 'indikator.sellproducts::lang.component.barion_size',
                'default' => '400',
                'type'    => 'dropdown',
                'options' => [
                    '200'  => '200px',
                    '300'  => '300px',
                    '400'  => '400px',
                    '500'  => '500px',
                    '800'  => '800px',
                    '1200' => '1200px'
                ]
            ]
        ];
    }

    public function onRun()
    {
        $this->page['barion']      = $this->property('barion');
        $this->page['barion_size'] = $this->property('barion_size');
    }
}
