<?php namespace Indikator\SellProducts\Models;

use Model;

class Orders extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'indikator_sellproducts_orders';

    public $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required',
        'status'     => 'required|between:3,6|numeric'
    ];

    protected $jsonable = [
        'products'
    ];

    public function getProductOptions()
    {
        $result = [];

        foreach (Products::orderBy('name', 'asc')->get()->all() as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }
}
