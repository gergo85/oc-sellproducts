<?php namespace Indikator\SellProducts\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_sellproducts_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('category', 3);
            $table->string('price', 10)->default(0);
            $table->string('sale_price', 10)->default(0);
            $table->text('summary')->nullable();
            $table->longtext('content')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('unit', 10)->default('piece');
            $table->string('quantity', 3)->default(1);
            $table->string('featured', 1)->default(0);
            $table->string('status', 1)->default(1);
            $table->integer('orders');
            $table->string('sort_order', 4)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_sellproducts_products');
    }
}
