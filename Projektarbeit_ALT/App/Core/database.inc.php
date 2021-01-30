<?php
function connect() {
  $pdo = null;           
  try 
  {
    $pdo = new PDO( 'mysql:host=localhost;dbname=ski_service;charset=utf8;port=3306',
                    'SkiKunde'
    );
  } 
  catch (PDOException $pe) 
  {
    die('Could not connect to the database: ' . $pe->getMessage());
  }
  return $pdo;
}
// Turns off the errors for security reasons. 
// $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>