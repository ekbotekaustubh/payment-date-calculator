<?php
use PHPUnit\Framework\TestCase;
include 'src/Report.php';

class ReportTest extends TestCase
{
    public function testGetDates()
    {
        $reportClass = new Report();
        $dates = $reportClass->getPaymentDates();
        $expected = [];

        $this->assertEquals($expected, $dates);
    }
}