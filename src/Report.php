<?php
namespace MiccoTest;

/**
 * Class Report
 * @package MiccoTest
 */
class Report
{
    /**
     * @var string
     */
    protected $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Get payment days.
     *
     * @return array
     */
    public function getSalaryDates(): array
    {
        $year = date('Y');
        $weekEnds = $this->getWeekEnds();
        $salaryDates[] = ['salaryDate', 'salaryDay', 'bonusDate', 'bonusDay'];

        for ($month = date('m'); $month <= 12; $month++) {

            $monthEnd = $this->getMonthEndDate($year, $month, $weekEnds);
            $bonusDate = $this->getBonusDate($year, $month, $weekEnds);

            $salaryDates[] = [
                $monthEnd,
                date('l', strtotime($monthEnd)),
                $bonusDate,
                date('l', strtotime($bonusDate))
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
    public function getMonthEndDate(int $year, int $month, array $weekEnds): string
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
    public function generateReport()
    {
        $salaryDates = $this->getSalaryDates();
        $csv = new \MiccoTest\CsvFileWriter();
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->fileName;

        if ($csv->write($filePath, $salaryDates, 'w')) {
            echo 'Report generated successfully. You can download it <a href="' . $filePath . '">Here</a>';
        } else {
            echo 'Error in writing file.';
        }
    }
}
