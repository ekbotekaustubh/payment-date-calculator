<?php
use PHPUnit\Framework\TestCase;

/**
 * Class ReportTest
 */
class ReportTest extends TestCase
{
    /**
     * Test salary dates.
     */
    public function testSalaryDates()
    {
        $reportClass = new MiccoTest\Report();
        $reportClass->setFileName('report.csv');
        $dates = $reportClass->getSalaryDates();
        $expected = [
            ['salaryDate', 'salaryDay', 'bonusDate', 'bonusDay'],
            ['29-03-2019', 'Friday', '15-3-2019', 'Friday'],
            ['30-04-2019', 'Tuesday', '15-4-2019','Monday',],
            ['31-05-2019', 'Friday','15-5-2019','Wednesday',],
            ['28-06-2019', 'Friday','19-06-2019','Wednesday',],
            ['31-07-2019', 'Wednesday','15-7-2019','Monday',],
            ['30-08-2019', 'Friday','15-8-2019','Thursday',],
            ['30-09-2019', 'Monday', '18-09-2019','Wednesday',],
            ['31-10-2019', 'Thursday', '15-10-2019', 'Tuesday', ],
            ['29-11-2019', 'Friday', '15-11-2019', 'Friday',],
            ['31-12-2019', 'Tuesday', '18-12-2019', 'Wednesday',]
        ];

        $this->assertEquals($expected, $dates);
    }

    /**
     * @param int $year
     * @param int $month
     * @param array $weekEnds
     * @param string $expected
     * @dataProvider monthEndDateDataProvider
     */
    public function testGetMonthEndDate(int $year, int $month, array $weekEnds, string $expected)
    {
        $reportClass = new MiccoTest\Report();
        $monthEnd = $reportClass->getMonthEndDate($year, $month, $weekEnds);

        $this->assertEquals($expected, $monthEnd);
    }

    /**
     * @param int $year
     * @param int $month
     * @param array $weekEnds
     * @param string $expected
     * @dataProvider bonusDateDataProvider
     */
    public function testGetBonusDate(int $year, int $month, array $weekEnds, string $expected)
    {
        $reportClass = new MiccoTest\Report();
        $bonusEnd = $reportClass->getBonusDate($year, $month, $weekEnds);

        $this->assertEquals($expected, $bonusEnd);
    }

    /**
     * @return array
     */
    public function monthEndDateDataProvider()
    {
        $weekends = ['Saturday', 'Sunday'];
        return [
            [2019, 3, $weekends, '29-03-2019'],
            [2019, 4, $weekends, '30-04-2019'],
            [2019, 5, $weekends, '31-05-2019'],
            [2019, 6, $weekends, '28-06-2019'],
            [2019, 7, $weekends, '31-07-2019'],
            [2019, 8, $weekends, '30-08-2019'],
            [2019, 9, $weekends, '30-09-2019'],
            [2019, 10, $weekends, '31-10-2019'],
            [2019, 11, $weekends, '29-11-2019'],
            [2019, 12, $weekends, '31-12-2019'],
        ];
    }

    /**
     * @return array
     */
    public function bonusDateDataProvider()
    {
        $weekends = ['Saturday', 'Sunday'];
        return [
            [2019, 3, $weekends, '15-3-2019'],
            [2019, 4, $weekends, '15-4-2019'],
            [2019, 5, $weekends, '15-5-2019'],
            [2019, 6, $weekends, '19-06-2019'],
            [2019, 7, $weekends, '15-7-2019'],
            [2019, 8, $weekends, '15-8-2019'],
            [2019, 9, $weekends, '18-09-2019'],
            [2019, 10, $weekends, '15-10-2019'],
            [2019, 11, $weekends, '15-11-2019'],
            [2019, 12, $weekends, '18-12-2019'],
        ];
    }
}
