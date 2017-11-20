<?php namespace Indikator\SellProducts\Models;

use Model;

class Category extends Model
{
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'indikator_sellproducts_category';

    public $rules = [
        'name'     => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_sellproducts_products'],
        'featured' => 'required|between:0,1|numeric',
        'status'   => 'required|between:1,2|numeric'
    ];

    protected $jsonable = [
        'payment'
    ];
}
