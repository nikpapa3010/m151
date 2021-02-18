<?php
session_start();

require_once 'requireAll.inc.php';
$prioritaeten = [];
$serviceobjekte = [];

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  $stmt = $pdo->prepare('select * from Prioritaet');
  $stmt->execute([]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Prioritaet');
  $prioritaeten = $stmt->fetchAll();
  
  $stmt = $pdo->prepare('select * from Serviceobjekt');
  $stmt->execute([]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Serviceobjekt');
  $serviceobjekte = $stmt->fetchAll();
  
  if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('select BenutzerID from benutzer where Email = :em');
    $stmt->execute([':em' => $_SESSION['username']]);
    $userid = $stmt->fetchColumn(0);

    $sd = date_format(date_create(), 'Y-m-d');
    $so = $_POST['Servicetyp'];
    $pr = $_POST['prio'];

    $stmt = $pdo->prepare('insert into Serviceauftrag (Startdatum, StatusFK, ServiceobjektFK, PrioFK, BenutzerFK) ' .
                          'values (:sd, 1, :so, :pr, :uid)');
    $stmt->execute([':sd' => $sd, ':so' => $so, ':pr' => $pr, ':uid' => $userid]);
    $redir = 'warenkorb.php';
  }
  $pdo->commit();
}
drawPageHead('Mietauftrag bearbeiten');
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
draweditServiceauftragView($_SESSION['isWarenkorb'], $serviceobjekte, $prioritaeten);
drawFooter();
drawPageFoot();
?>