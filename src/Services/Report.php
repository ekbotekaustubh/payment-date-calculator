<?php
namespace PaymentDateCalculator\Services;
use PaymentDateCalculator\Services\{
    CsvFileWriter,
    Calculator
};

/**
 * Class Report
 * @package MiccoTest
 */
class Report
{
    /**
     * @var Calculator
     */
    protected $calculatorService;

    /**
     * @return Calculator
     */
    public function getCalculatorService(): Calculator
    {
        if (null === $this->calculatorService) {
            $this->calculatorService = new Calculator();
        }

        return $this->calculatorService;
    }

    /**
     * @param Calculator $calculatorService
     * @return Report
     */
    public function setCalculatorService(Calculator $calculatorService): Report
    {
        $this->calculatorService = $calculatorService;

        return $this;
    }

    /**
     * Generate report.
     *
     * @param string $fileName
     * @param int $month
     * @param int $year
     */
    public function generateReport(string $fileName, int $month, int $year)
    {
        $salaryDates = $this->getCalculatorService()->getPaymentDates($month, $year);
        $csv = new CsvFileWriter();

        if ($csv->write($fileName, $salaryDates, 'w')) {
            echo 'Report generated successfully.';
        } else {
            echo 'Error in writing file.';
        }
    }
}
