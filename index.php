<?php

require "./App/autoload.php";
require "./App/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/app");
$dotenv->load();

/*
use Controllers\Email;
$email = new Email($_ENV['EMAIL_NAME'], $_ENV['EMAIL'], $_ENV['EMAIL_PASSWORD']);
var_dump($email->send($_ENV['EMAIL_TO'], $_ENV['EMAIL_NAME_TO'], "Testando Email", "<h1>Teste de envio de email usando variaveis de ambiente.</h1>"));
echo "<br>";
*/

use Controllers\Router;
$router = new Router();
echo $router->router_verify($_SERVER, file_get_contents('php://input'));