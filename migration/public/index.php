<?php
require_once __DIR__.'/../vendor/autoload.php';
use core\Database;

$_ENV = parse_ini_file("../Database.ini");
$config = [
    'dsn' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
];
$db = new Database($config);
echo $db->createMigrationTable();
var_dump($db->testConnection());