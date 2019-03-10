<?php
use PHPUnit\Framework\TestCase;
use PaymentDateCalculator\Services\{
    Calculator,
    Report
};

/**
 * Class ReportTest
 */
class ReportTest extends TestCase
{
    /**
     * Test report generation functionality.
     */
    public function testGenerateReport()
    {
        $reportService = new Report();
        $calculatorServiceMock = Mockery::mock(Calculator::class);

        $calculatorServiceMock
            ->shouldReceive('getPaymentDates')
            ->once()
            ->with(Mockery::on(function ($argument) {
                return is_int($argument);
            }),
            Mockery::on(function ($argument) {
                return is_int($argument);
            }))
            ->andReturn([['March', '29-03-2019', '15-03-2019']]);

        $reportService->setCalculatorService($calculatorServiceMock);
        $reportService->generateReport('report-test.csv', 3, 2019);

        $this->assertEquals(trim(file_get_contents('report-test.csv')), 'March,29-03-2019,15-03-2019');
    }

    /**
     * Delete generated file.
     */
    public function tearDown()
    {
        unlink('report-test.csv');
    }
}
