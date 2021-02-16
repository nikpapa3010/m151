<?php
session_start();

require_once 'requireAll.inc.php';

$redir = null;

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}
if (isset($_SESSION['username'])) {
  if (isset($_POST['submit'])) {
    $pdo = Database::connect($_SESSION['berechtigung']);
    $pdo->beginTransaction();
    $sql = 'update Serviceauftrag set StatusFK = 2 where StatusFK = 1 and BenutzerFK = (select BenutzerID from benutzer where Email = :em)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':em' => $_SESSION['username']]);
    $sql = 'update Mietauftrag set StatusFK = 2 where StatusFK = 1 and BenutzerFK = (select BenutzerID from benutzer where Email = :em)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':em' => $_SESSION['username']]);
    $pdo->commit();
    print_r($stmt->errorInfo());
  }
} else {
  $redir = 'login.php?redirect=warenkorb.php';
}

drawPageHead('Bestellung abschliessen', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawAbschliessenView();
drawFooter();
drawPageFoot();
?>