<?php
namespace MiccoTest;

/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 1/3/19
 * Time: 11:03 PM
 */
class csv implements FileWriter
{
    /**
     * @param string $fileName
     * @param array $data
     * @param string $mode
     * @return mixed|void
     */
    public function write(string $fileName, array $data, string $mode)
    {
        $handle = fopen($fileName, $mode);

        fputcsv($handle, $data);

        fclose($handle);
    }
}