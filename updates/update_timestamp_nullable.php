<?php namespace Indikator\SellProducts\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('indikator_sellproducts_orders');
        DbDongle::convertTimestamps('indikator_sellproducts_products');
    }

    public function down()
    {
        // ...
    }
}
