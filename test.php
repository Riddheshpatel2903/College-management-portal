<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$req = Illuminate\Http\Request::create('/', 'GET');
$res = $app->handle($req);
echo "Status: " . $res->getStatusCode() . "\n";
if ($res->getStatusCode() == 302) {
    echo "Location: " . $res->headers->get('Location') . "\n";
}
