<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
abstract class AbstractClass
{
    function __construct()
    {
        echo 'abstract class';
    }

    public function add() {
        echo 'add';
    }
}
class A extends AbstractClass
{
    function __construct()
    {
        echo 'normal class ';
        parent::__construct();
    }
}
try {
    $a = new a();
    $a->add();
} catch (Exception $e) {
    print_r($e);exit;
}

interface Abc
{
    public function abcd();
}
class B implements Abc
{
    public function Abcd()
    {

    }
}
?>