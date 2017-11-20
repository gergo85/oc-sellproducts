<?php namespace Indikator\SellProducts\Classes\Barion\Helpers;

include "iBarionModel.php";
include "BarionHelper.php";

$include_dirs = [
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "common"))),
    realpath(join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), "models")))
];

foreach ($include_dirs as $dir) {
    foreach (glob($dir . '/*.php') as $file) {
        include_once $file;
    }
}
