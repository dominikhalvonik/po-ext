<?php
include_once "classes/Printer.php";
include_once "classes/DB.php";

use Classes\Printer;
use Classes\DB;

/**
$printer = new Printer("");
$printer->printName("Oliver", 100);

var_dump($printer->getMemory());
 **/

$db = new DB("localhost", "root", "", "portalove_ext", "3306");
$pole = [1,2,3,5, 'test' => 5];

foreach ($pole as $key => $value) {
    echo "Toto je kluc: " . $key . " <br>";
    echo "Toto je hodnota: " . $value . " <br>";
}