<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$users = [];
$redir = null;

if (isset($_SESSION['username'])) {
  if ($_SESSION['berechtigung'] > 0) {
    $pdo = Database::connect($_SESSION['berechtigung']);
    $stmt = $pdo->prepare('select * from Benutzer_Rang');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Rang');
    $users = $stmt->fetchAll();
  } else {
    $redir = 'profileOptions.php';
  }
} else {
  $redir = 'login.php?redirect=benutzerliste.php';
}

drawPageHead('Benutzerliste', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawBenutzerlisteView($users);
drawFooter();
drawPageFoot();
?>