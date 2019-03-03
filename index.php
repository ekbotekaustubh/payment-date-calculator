<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('MiccoTest\\', __DIR__.'/src');
$loader->addPsr4('MiccoTest\\Tests\\', __DIR__);


$report = new MiccoTest\Report();
$report->generateReport();