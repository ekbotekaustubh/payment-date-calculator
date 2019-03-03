<?php
namespace MiccoTest;

/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 23/2/19
 * Time: 9:05 PM
 */
class Report
{
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
            $monthEnd = date('t-m-Y', strtotime($year . '-' . $month . '-1'));
            $monthEndDay = date('l', strtotime($monthEnd));

            if (false !== ($position = array_search($monthEndDay, $weekEnds))) {
                $monthEnd = date('d-m-Y', strtotime($monthEnd . ' - ' . ($position + 1) . ' day'));
            }

            $bonusDate = '15-'. $month . '-' . $year;
            $bonusDay = date('l', strtotime($bonusDate));

            if (false !== ($position = array_search($bonusDay, $weekEnds))) {
                $bonusDate = date('d-m-Y', strtotime($bonusDate . ' + ' . (4 - $position) . ' day'));
            }

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
     * Generate report.
     */
    public function generateReport()
    {
        $salaryDates = $this->getSalaryDates();
        $csv = new \MiccoTest\CsvFileWriter();
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/report.csv';
        if ($csv->write($filePath, $salaryDates, 'w')) {
            echo 'Report generated successfully. You can download it <a href="/report.csv">Here</a>';
        } else {
            echo 'Error in writing file.';
        }
    }
}
