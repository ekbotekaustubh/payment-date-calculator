<?php
namespace PaymentDateCalculator\Services;

/**
 * Interface FileWriter
 * @package PaymentDateCalculator\Services
 */
interface FileWriter
{
    /**
     * File write operation.
     *
     * @param string $filename
     * @param array $data
     * @param string $mode
     * @return mixed
     */
    public function write(string $filename, array $data, string $mode);
}
