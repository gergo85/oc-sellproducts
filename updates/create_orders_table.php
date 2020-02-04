<?php namespace Indikator\SellProducts\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_sellproducts_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user', 6)->default(0);
            $table->text('products')->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('billing_name', 100)->nullable();
            $table->string('billing_zipcode', 10)->nullable();
            $table->string('billing_city', 100)->nullable();
            $table->string('billing_address', 100)->nullable();
            $table->string('shipping_name', 100)->nullable();
            $table->string('shipping_zipcode', 10)->nullable();
            $table->string('shipping_city', 100)->nullable();
            $table->string('shipping_address', 100)->nullable();
            $table->string('comment', 500)->nullable();
            $table->string('payment', 20)->nullable();
            $table->string('status', 1)->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_sellproducts_orders');
    }
}
