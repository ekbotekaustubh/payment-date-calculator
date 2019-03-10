<?php
namespace PaymentDateCalculator\Services;

/**
 * Class Calculator
 * @package PaymentDateCalculator\Services
 */
class Calculator
{
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
        $monthEnd = date('t-m-Y', strtotime(sprintf('%d-%d-1', $year, $month)));
        $monthEndDay = date('l', strtotime($monthEnd));

        if (false !== ($position = array_search($monthEndDay, $weekEnds))) {
            $monthEnd = date('d-m-Y', strtotime(sprintf('%s - %d day', $monthEnd, ($position + 1))));
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
        $bonusDate = date('15-m-Y', strtotime(sprintf('15-%s-%d', $month, $year)));
        $bonusDay = date('l', strtotime($bonusDate));

        if (false !== ($position = array_search($bonusDay, $weekEnds))) {
            $bonusDate = date('d-m-Y', strtotime(sprintf('%s + %d day', $bonusDate, (4 - $position))));
        }

        return $bonusDate;
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
            $salaryDates[] = [
                date('F', strtotime($monthEnd)),
                $monthEnd,
                $this->getBonusDate($year, $monthNumber, $weekEnds)
            ];
        }

        return $salaryDates;
    }
}
