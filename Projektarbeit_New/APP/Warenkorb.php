<?php
session_start();

require_once 'requireAll.inc.php';

$mietauftraege = [];
$serviceauftraege = [];

if (isset($_SESSION['username'])) {
  $em = $_SESSION['username'];
  $pdo = Database::connect($_SESSION['berechtigung']);

  $sql = 'select * from Benutzer_Mietauftrag where anzInWk = true and Email = :em';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':em' => $em]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Mietauftrag');
  $mietauftraege = $stmt->fetchAll();
  
  $sql = 'select * from Benutzer_Serviceauftrag where anzInWk = true and Email = :em';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':em' => $em]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Serviceauftrag');
  $serviceauftraege = $stmt->fetchAll();
}

drawPageHead('Warenkorb', isset($_SESSION['username']) ? null : 'login.php?redirect=warenkorb.php');
drawNavbar(isset($_SESSION['username']));
drawAuftragslisteView(false, $mietauftraege, $serviceauftraege, true);
drawFooter();
drawPageFoot();
?>
