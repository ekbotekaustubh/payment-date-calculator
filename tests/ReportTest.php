<?php
use PHPUnit\Framework\TestCase;
include 'src/Report.php';

class ReportTest extends TestCase
{
    /**
     * Test salary dates.
     */
    public function testSalaryDates()
    {
        $reportClass = new Report();
        $dates = $reportClass->getSalaryDates();
        $expected = [
            ['date' => '2019-02-28', 'day' => 'Thursday',],
            ['date' => '2019-03-29', 'day' => 'Friday',],
            ['date' => '2019-04-30', 'day' => 'Tuesday',],
            ['date' => '2019-05-31', 'day' => 'Friday',],
            ['date' => '2019-06-28', 'day' => 'Friday',],
            ['date' => '2019-07-31', 'day' => 'Wednesday',],
            ['date' => '2019-08-30', 'day' => 'Friday',],
            ['date' => '2019-09-30', 'day' => 'Monday',],
            ['date' => '2019-10-31', 'day' => 'Thursday',],
            ['date' => '2019-11-29', 'day' => 'Friday',],
            ['date' => '2019-12-31', 'day' => 'Tuesday',]
        ];

        $this->assertEquals($expected, $dates);
    }

    public function testBonusDates()
    {
        $reportClass = new Report();
        $dates = $reportClass->getBonusDates();
        $expected = [];

        $this->assertEquals($expected, $dates);
    }
}