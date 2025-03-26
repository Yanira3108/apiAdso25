<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Encabezados
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Content-Type: application/json; charset=UTF-8");

// Obtiene la URL de la solicitud
$request = explode("/", trim($_SERVER["REQUEST_URI"]));
$method = $_SERVER["REQUEST_METHOD"];
$table = ucfirst(strtolower($request[2])) . "Controller";

// Carga el archivo del controlador correspondiente
$controllerFile = __DIR__. DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $table . ".php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $tableController = new $table;

    switch ($method) {
        case 'GET':
            if (isset($request[3]) && !empty($request[3])) {
                $tableController->getById($request[3]);
            } else {
                $tableController->get();
            }
            break;

        case 'POST':
            $tableController->create();
            break;

        case 'PUT':
            $tableController->update($request[3]);
            break;

        case 'DELETE':
            $tableController->delete($request[3]);
            break;

        case 'PATCH':
            $tableController->patch($request[3]);
            break;

        default:
            echo json_encode(["message" => "Método no permitido"]);
            break;
    }
} else {
    echo json_encode(["message" => "Recurso no permitido"]);
}
?>


