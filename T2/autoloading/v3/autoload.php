<?php
require_once 'autoloader.php';

/*
autoloader mit Klasse
*/
Autoloader::register();
  
$myClass = new MyClass();
echo "MyName =" . $myClass->MyName . '</br>';

?>