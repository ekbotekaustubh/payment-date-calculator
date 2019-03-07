<?php
namespace PaymentDateCalculator;
use PaymentDateCalculator\CsvFileWriter;

/**
 * Class Report
 * @package MiccoTest
 */
class Report
{
    /**
     * @var string
     */
    protected $fileName = '';

    /**
     * Get file name.
     *
     * @return string
     */
    public function getFileName(): string
    {
        if ('' === $this->fileName) {
            $this->fileName = 'report.csv';
        }

        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return Report
     */
    public function setFileName(string $fileName): Report
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get payment days.
     *
     * @param int $month
     * @param int $year
     * @return array
     */
    public function getPaymentDates(int $month, int $year): array
    {
        $weekEnds = $this->getWeekEnds();
        $salaryDates[] = ['Month', 'Salary Date', 'Bonus Date'];

        for ($monthNumber = $month; $monthNumber <= 12; $monthNumber++) {

            $monthEnd = $this->getSalaryDate($year, $monthNumber, $weekEnds);
            $bonusDate = $this->getBonusDate($year, $monthNumber, $weekEnds);

            $salaryDates[] = [
                date('F', strtotime($monthEnd)),
                $monthEnd,
                $bonusDate
            ];
        }

        return $salaryDates;
    }

    /**
     * Get weekend days
     *
     * @return array
     */
    public function getWeekEnds()
    {
        return [
            'Saturday',
            'Sunday'
        ];
    }

    /**
     * Calculate month end date.
     * If month end is weekend then get date of last working day of month.
     *
     * @param int $year
     * @param int $month
     * @param array $weekEnds
     * @return string
     */
    public function getSalaryDate(int $year, int $month, array $weekEnds): string
    {
        $monthEnd = date('t-m-Y', strtotime($year . '-' . $month . '-1'));
        $monthEndDay = date('l', strtotime($monthEnd));

        if (false !== ($position = array_search($monthEndDay, $weekEnds))) {
            $monthEnd = date('d-m-Y', strtotime($monthEnd . ' - ' . ($position + 1) . ' day'));
        }

        return $monthEnd;
    }

    /**
     * Calculate bonus date of month.
     * Which is 15 by default. If 15 is weekend then get date of next wednesday.
     *
     * @param int $year
     * @param int $month
     * @param array $weekEnds
     * @return string
     */
    public function getBonusDate(int $year, int $month, array $weekEnds): string
    {
        $bonusDate = '15-'. $month . '-' . $year;
        $bonusDay = date('l', strtotime($bonusDate));

        if (false !== ($position = array_search($bonusDay, $weekEnds))) {
            $bonusDate = date('d-m-Y', strtotime($bonusDate . ' + ' . (4 - $position) . ' day'));
        }

        return $bonusDate;
    }

    /**
     * Generate report.
     */
    public function generateReport($month, $year)
    {
        $salaryDates = $this->getPaymentDates($month, $year);
        $csv = new CsvFileWriter();
        $filePath = $this->getFileName();

        if ($csv->write($filePath, $salaryDates, 'w')) {
            echo 'Report generated successfully. You can download it <a href="' . $filePath . '">Here</a>';
        } else {
            echo 'Error in writing file.';
        }
    }
}
