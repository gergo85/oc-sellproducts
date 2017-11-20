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
            $table->string('price', 10)->default(0);
            $table->string('category', 3)->default(0);
            $table->text('summary')->nullable();
            $table->longtext('content')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('is_old', 1)->default(0);
            $table->string('is_sale', 1)->default(0);
            $table->string('sale_price', 10)->default(0);
            $table->timestamp('sale_start')->nullable();
            $table->timestamp('sale_end')->nullable();
            $table->string('featured', 1)->default(0);
            $table->string('status', 1)->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_sellproducts_products');
    }
}
