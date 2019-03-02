<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 23/2/19
 * Time: 9:05 PM
 */
class Report
{
    /**
use MiccoTest;
     * Get payment days.
     *
     * @return array
     */
    public function getSalaryDates(): array
    {
        $year = date('Y');
        $weekEnds = $this->getWeekEnds();
        $salaryDates = [];
        for ($month = date('m'); $month <= 12; $month++) {
            $monthEnd = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
            $monthEndDay = date('l', strtotime($monthEnd));

            if (false !== ($position = array_search($monthEndDay, $weekEnds))) {
                $monthEnd = date('Y-m-d', strtotime($monthEnd . ' - ' . ($position + 1) . ' day'));
            }

            $bonusDate = $year . '-' . $month . '-15';
            $bonusDay = date('l', strtotime($bonusDate));

            if (false !== ($position = array_search($bonusDay, $weekEnds))) {
                $bonusDate = date('Y-m-d', strtotime($bonusDate . ' + ' . (4 - $position) . ' day'));
            }

            $salaryDates[] = [
                'salaryDate' => $monthEnd,
                'salaryDay' => date('l', strtotime($monthEnd)),
                'bonusDate' => $bonusDate,
                'bonusDay' => date('l', strtotime($bonusDate))
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
}

$report = new Report();
$salaryDates = $report->getSalaryDates();
$csv = new MiccoTest\csv();
$csv->write('report.csv', $salaryDates, '+w');