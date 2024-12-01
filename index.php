<?php 

// as we are using strict types in our methods
declare(strict_types=1);

// class autoloading
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[3] != "films") {
    http_response_code(404);
    exit;
}

$id = $parts[4] ?? null;

$config = require 'config.php';
$database = new DataBase(
    $config["host"], 
    $config["dbname"], 
    $config["username"], 
    $config["password"]
);

$gateway = new FilmGateway($database);

$controller = new FilmController($gateway);
$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);