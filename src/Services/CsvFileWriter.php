<?php
namespace PaymentDateCalculator\Services;

/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 1/3/19
 * Time: 11:03 PM
 */
class CsvFileWriter implements FileWriter
{
    /**
     * @param string $fileName
     * @param array $data
     * @param string $mode
     * @return bool
     */
    public function write(string $fileName, array $data, string $mode): bool
    {
        $handle = fopen($fileName, $mode);

        if (!$handle) {
            return false;
        }

        foreach ($data as $values) {
            if (false === fputcsv($handle, $values)) {
                fclose($handle);
                return false;
            }
        }

        fclose($handle);

        return true;
    }
}