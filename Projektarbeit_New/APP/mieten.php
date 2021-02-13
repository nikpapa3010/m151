<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];

if (isset($_POST['submit'])) {
  $groesse = $_POST['groesse'];
  $gesch = $_POST['gesch'];
  $alter = $_POST['alter'];
  $start = $_POST['start'];
  $ende = $_POST['ende'];

  
}

drawPageHead('Mieten');
drawNavbar(isset($_SESSION['username']));

drawFooter();
drawPageFoot();
?>