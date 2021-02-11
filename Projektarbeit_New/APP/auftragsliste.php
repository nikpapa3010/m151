<?php
session_start();

require_once 'requireAll.inc.php';

$mietauftraege = [];
$serviceauftraege = [];

if (!isset($_SESSION['username'])) {
  ?>
  <meta http-equiv="refresh" content="0; url='.'" />
  <?php
} else {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $sql = 'select * from Benutzer_Mietauftrag';
  if ($_SESSION['berechtigung'] == 0) {
    $sql .= ' where Email = :un';
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':un' => $_SESSION['username']]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Mietauftrag');
  $mietauftraege = $stmt->fetchAll();
  
  $sql = 'select * from Benutzer_Serviceauftrag';
  if ($_SESSION['berechtigung'] == 0) {
    $sql .= ' where Email = :un';
  }
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':un' => $_SESSION['username']]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Serviceauftrag');
  $mietauftraege = $stmt->fetchAll();
}

drawPageHead('Registrieren');
drawNavbar(isset($_SESSION['username']));
// Auftragsliste-View anzeigen
drawFooter();
drawPageFoot();
?>