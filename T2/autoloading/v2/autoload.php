<?php

/*
Funktion autoload überschreiben
*/
function my_autoload($class_name)
{
  $file = 'classes/' . strtolower($class_name) . '.class.php';
  if(file_exists($file))
  {
    require_once($file);
  }
}

spl_autoload_register('my_autoload');

$myClass = new MyClass();
echo "MyName =" . $myClass->MyName . '</br>';

?>