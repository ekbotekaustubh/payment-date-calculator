<?php
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
    public function getPaymentDates(): array
    {
        $year = date('Y');
        $weekEnds = $this->getWeekEnds();
        $salaryDates = [];
        for ($month = date('m'); $month <= 12; $month++) {
            $monthEnd = date('Y-m-t', strtotime($year . '-' . $month . '-1'));
            $monthEndDay = date('l', strtotime($monthEnd));

            if ($position = array_search($monthEndDay, $weekEnds)) {
                $position;
            }

            $salaryDates[] = $monthEnd;
        }
        $dates = [];
        return $dates;
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