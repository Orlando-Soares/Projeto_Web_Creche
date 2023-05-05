<?php
require "autoload.php";
require "./vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//var_dump($_ENV['DB_USER']);

use Controllers\Email;

$email = new Email($_ENV['EMAIL_NAME'], $_ENV['EMAIL'], $_ENV['EMAIL_PASSWORD']);
var_dump($email->send($_ENV['EMAIL_TO'], $_ENV['EMAIL_NAME_TO'], "Testando Email", "<h1>Teste de envio de email usando variaveis de ambiente.</h1>"));

echo "Página inicial.";
