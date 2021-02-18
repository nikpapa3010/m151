<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$redir = null;
if (isset($_SESSION['username'])) {
  if (isset($_POST['confirm'])) {
    $pdo = Database::connect($_SESSION['berechtigung']);
    $pdo->beginTransaction();

    

    $pdo->commit();

    $redir = 'warenkorb.php';
  }
}

drawPageHead('Warenkorb leeren', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawWarenkorbLeerenView();
drawFooter();
drawPageFoot();
?>