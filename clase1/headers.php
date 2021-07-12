<?php

header('X-Nombre-Profe: Andy');
header('Content-Type: application/json');

$los_header = getallheaders();

$data = ["datosTarjeta" => [
    "frente" => "ANDRES MARI VAZQUEZ",
    "numero" => "4546-3513-1545-1111",
    "cvv" => "165",
    "headersRecibidos" => $los_header
]];

echo json_encode($data).PHP_EOL;

?>