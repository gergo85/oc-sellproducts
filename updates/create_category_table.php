<?php namespace Indikator\SellProducts\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_sellproducts_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->text('summary')->nullable();
            $table->longtext('content')->nullable();
            $table->text('payment')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('currency', 20)->default('USD');
            $table->string('unit', 20)->default('piece');
            $table->string('sort_order', 3)->default(1);
            $table->string('featured', 1)->default(0);
            $table->string('status', 1)->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_sellproducts_category');
    }
}
