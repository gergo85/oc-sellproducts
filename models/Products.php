<?php namespace Indikator\SellProducts\Models;

use Model;

class Products extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'indikator_sellproducts_products';

    public $rules = [
        'name'     => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_sellproducts_products'],
        'is_old'   => 'required|between:0,1|numeric',
        'is_sale'  => 'required|between:0,1|numeric',
        'featured' => 'required|between:0,1|numeric',
        'status'   => 'required|between:1,2|numeric'
    ];

    public function getCategoryOptions()
    {
        $result = [];

        foreach (Category::orderBy('name', 'asc')->get()->all() as $item) {
            $result[$item->id] = $item->name;
        }

        return $result;
    }
}
