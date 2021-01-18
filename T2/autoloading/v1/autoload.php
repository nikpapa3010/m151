<?php

/*
Funktion autoload überschreiben
*/
function my_autoload($class_name)
{
  echo 'auto load class ' . $class_name . '</br>';
  require_once 'classes/' . strtolower($class_name) . '.class.php';
}

$myClass = new MyClass();
echo "MyName =" . $myClass->MyName . '</br>';

?>