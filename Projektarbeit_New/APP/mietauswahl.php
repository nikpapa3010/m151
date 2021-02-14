<?php
session_start();

require_once 'requireAll.inc.php';

if (isset($_GET['groesse']) && isset($_GET['gesch']) && isset($_GET['alter']) &&
    isset($_GET['start']) && isset($_GET['dauer']) && isset($_GET['objtyp'])) {
  $groesse = $_GET['groesse'];
  $gesch = $_GET['gesch'];
  $alter = $_GET['alter'];
  $start = $_GET['start'];
  $dauer = $_GET['dauer'];
  $objtyp = $_GET['objtyp'];

  $pdo = Database::connect($_SESSION['berechtigung']);
}

drawPageHead('Mietauswahl');
drawNavbar(isset($_SESSION['username']));

drawFooter();
drawPageFoot();
?>