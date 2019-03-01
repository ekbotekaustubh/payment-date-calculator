<?php
/**
 * Created by PhpStorm.
 * User: tonystark
 * Date: 1/3/19
 * Time: 11:03 PM
 */
class csv implements FileWritter
{
    /**
     * @param string $fileName
     * @param array $data
     * @param string $mode
     * @return mixed|void
     */
    public function write(string $fileName, array $data, $mode)
    {
        $handle = fopen($fileName, $mode);

        return fputcsv($handle, $data);
    }
}