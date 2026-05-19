<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$req = Illuminate\Http\Request::create('/login', 'GET');
$res = $app->handle($req);
echo "Status: " . $res->getStatusCode() . "\n";
