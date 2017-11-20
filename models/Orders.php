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
        'phone'      => 'required',
        'status'     => 'required|between:1,3|numeric'
    ];

    protected $jsonable = [
        'products'
    ];

    public function getProductOptions()
    {
        $result = [];

        foreach (Products::orderBy('name', 'asc')->get() as $item) {
            $currency = Category::where('id', $item->category)->pluck('currency');
            $result[$item->id] = $item->name.'  &nbsp;|&nbsp; '.$item->price.' '.$currency;
        }

        return $result;
    }
}
