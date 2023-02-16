<?php
require_once __DIR__ . '/../vendor/autoload.php';

use core\Request;
use core\Response;

$request = new Request();
$response = new Response();
if ($request->method()== 'POST') {
    $response->redirect("/home") . "<br>";
}
echo $request->getPath()."<br>";
echo $request->method()."<br>";