<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$mietauftraege = [];
$serviceauftraege = [];
$redir = null;
$_SESSION['isWarenkorb'] = false;

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);

  $sql = 'select * from Benutzer_Mietauftrag where anzInView = true';
  if ($_SESSION['berechtigung'] == 0) {
    $sql .= ' and Email = :em';
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':em' => $_SESSION['username']]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Mietauftrag');
  $mietauftraege = $stmt->fetchAll();
  
  $sql = 'select * from Benutzer_Serviceauftrag where anzInView = true';
  if ($_SESSION['berechtigung'] == 0) {
    $sql .= ' and Email = :em';
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':em' => $_SESSION['username']]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Serviceauftrag');
  $serviceauftraege = $stmt->fetchAll();
} else {
  $redir = 'login.php?redirect=auftragsliste.php';
}

drawPageHead('Registrieren', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawAuftragslisteView($_SESSION['berechtigung'] > 0, $mietauftraege, $serviceauftraege, false);
drawFooter();
drawPageFoot();
?>