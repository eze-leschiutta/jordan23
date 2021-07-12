<?php

require_once('vendor/autoload.php');
require_once('utiles/MySQLUtil.php');

$verboHTTP = $_SERVER['REQUEST_METHOD'];

switch ($verboHTTP) {
    case 'GET':
        doGet();
        break;
    case 'POST':
        doPost();
        break;
    case 'PUT':
        doPut();
        break;
    case 'DELETE':
        doDelete();
        break;
    default:
        http_response_code(405);
        break;
}

function verificarQueLaUrlContengaId() {
    $arr = explode('/', $_SERVER['REQUEST_URI']);
    if (count($arr) == 3) {
        $id = $arr[2];
        if (strlen($id) == 36) {
            return true;
        }
    }
    responder(["mensaje"=>"No vino ID o ID no contiene 36 caracteres"], 400);
    return false;
}

function extraerId() {
    $arr = explode('/', $_SERVER['REQUEST_URI']);
    return $arr[2];
}

function responder($obj, $status) {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($obj).PHP_EOL;
}

function doGet() {
    if (verificarQueLaUrlContengaId()) {
        responder(["OK VINO ID"=>extraerId()], 200);
    }
}

function doPost() {
    $contenido = file_get_contents('php://input');
    $objCont = json_decode($contenido);
    $key = "saludo";
    $value = "hola";
    // $objCont[$key] = $value;
    responder($objCont, 201);
}

function doPut() {
    if (verificarQueLaUrlContengaId()) {
        responder('OK', 200);
    }
}

function doDelete() {
    if (verificarQueLaUrlContengaId()) {
        responder('OK', 200);
    }
}

?>