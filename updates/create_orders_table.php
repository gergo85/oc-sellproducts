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
            $table->text('products');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('phone', 50)->nullable();
            $table->string('billing_name', 100)->nullable();
            $table->string('billing_zipcode', 10)->nullable();
            $table->string('billing_city', 50)->nullable();
            $table->string('billing_address', 100)->nullable();
            $table->string('shipping_name', 100)->nullable();
            $table->string('shipping_zipcode', 10)->nullable();
            $table->string('shipping_city', 50)->nullable();
            $table->string('shipping_address', 100)->nullable();
            $table->string('comment', 191)->nullable();
            $table->string('payment', 10)->default('barion');
            $table->string('category', 3);
            $table->integer('total');
            $table->string('status', 1)->default(3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_sellproducts_orders');
    }
}
