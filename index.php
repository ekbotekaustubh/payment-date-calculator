<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
use PaymentDateCalculator\Report;


$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('PaymentDateCalculator\\', __DIR__.'/src');
$loader->addPsr4('PaymentDateCalculator\\tests\\', __DIR__);

$month = (int)$argv[2] ?? date('m');
$year = (int)$argv[3] ?? date('Y');
$file = $argv[1] ?? 'report.csv';

$report = new Report();
$report->setFileName($file);
$report->generateReport($month, $year);