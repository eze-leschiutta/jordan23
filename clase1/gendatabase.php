<?php

require_once('vendor/autoload.php');
require_once('utiles/MySQLUtil.php');

use Ramsey\Uuid\Uuid;
use Faker\Factory;
use Utiles\MySQLUtil;

function crearPersonaRandom() {
    $faker = Factory::create();

    $obj = [
        "id" => Uuid::uuid4()->toString(),
        "name" => $faker->name,
        "streetName" => $faker->streetName,
        "buildingNumber" => $faker->buildingNumber,
        "city" => $faker->city,
        "postcode" => $faker->postcode,
        "state" => $faker->state,
        "country" => $faker->country
    ];

    return $obj;
}

function transformar($obj) {
    $arr = [];
    foreach ($obj as $key => $value) {
        array_push($arr, "'".$value."'");
    }
    return $arr;
}

function crearRegistro($obj) {
    $col = ["id", "name", "streetName", "buildingNumber","city", "postcode", "state", "country"];
    $arrSQL = ["INSERT personas (", implode(",", $col), ") VALUES (",
        implode(",", $obj)
    ];
    return implode("", $arrSQL);
}



$kv = crearPersonaRandom();

// $res = array_map(function($z) { return $z; }, $kv);

$res = transformar($kv);
var_dump($res);
$record = crearRegistro($res);

echo json_encode($record).PHP_EOL;

?>