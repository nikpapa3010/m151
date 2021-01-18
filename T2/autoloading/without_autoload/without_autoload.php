<?php

require_once 'classes/myclass.class.php';

$myClass = new MyClass();
echo "MyName = " . $myClass->MyName . '</br>';

if($_POST['test'])
{
    $a = new MyClassA();
}
else
{
    $b = new MyClassB();
}

?>