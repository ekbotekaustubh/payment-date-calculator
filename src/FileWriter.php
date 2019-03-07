<?php
namespace PaymentDateCalculator;

/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 1/3/19
 * Time: 10:57 PM
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