<?php

$verbo = $_SERVER['REQUEST_METHOD'];

echo json_encode(["verbo" => $verbo]);

?>