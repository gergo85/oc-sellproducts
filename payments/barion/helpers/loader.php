<?php namespace Indikator\SellProducts\Payments\Barion\Helpers;

include "iBarionModel.php";
include "BarionHelper.php";

$include_dirs = Array(
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "common"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models/common"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models/secure"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models/payment"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models/refund")))
);

foreach ($include_dirs as $dir) {
    foreach (glob($dir . '/*.php') as $file) {
        include_once $file;
    }
}