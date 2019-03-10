<?php
use PHPUnit\Framework\TestCase;
use PaymentDateCalculator\Services\Calculator;
/**
 * Class CalculatorTest
 */
class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    protected $calculatorService;

    /**
     * Basic set up.
     */
    public function setUp()
    {
        $this->calculatorService = new Calculator();
    }
    /**
     * Test salary dates.
     */
    public function testSalaryDates()
    {
        $dates = $this->calculatorService->getPaymentDates(3, 2019);
        $expected = [
            ['Month', 'Salary Date', 'Bonus Date'],
            ['March', '29-03-2019', '15-03-2019'],
            ['April', '30-04-2019', '15-04-2019'],
            ['May', '31-05-2019', '15-05-2019'],
            ['June', '28-06-2019', '19-06-2019'],
            ['July', '31-07-2019', '15-07-2019'],
            ['August', '30-08-2019', '15-08-2019'],
            ['September', '30-09-2019', '18-09-2019'],
            ['October', '31-10-2019', '15-10-2019'],
            ['November', '29-11-2019', '15-11-2019'],
            ['December', '31-12-2019', '18-12-2019']
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
        $monthEnd = $this->calculatorService->getSalaryDate($year, $month, $weekEnds);

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
        $bonusEnd = $this->calculatorService->getBonusDate($year, $month, $weekEnds);

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
            [2019, 3, $weekends, '15-03-2019'],
            [2019, 4, $weekends, '15-04-2019'],
            [2019, 5, $weekends, '15-05-2019'],
            [2019, 6, $weekends, '19-06-2019'],
            [2019, 7, $weekends, '15-07-2019'],
            [2019, 8, $weekends, '15-08-2019'],
            [2019, 9, $weekends, '18-09-2019'],
            [2019, 10, $weekends, '15-10-2019'],
            [2019, 11, $weekends, '15-11-2019'],
            [2019, 12, $weekends, '18-12-2019'],
        ];
    }
}
