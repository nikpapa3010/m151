<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

if (isset($_SESSION['username']) && isset($_POST['submit'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();
  
  $stmt = $pdo->prepare('select BenutzerID from benutzer where Email = :em');
  $stmt->execute([':em' => $_SESSION['username']]);
  $userid = $stmt->fetchColumn(0);

  $resdat = date_format(date_create(), 'Y-m-d');
  $start = $_SESSION['start'];
  $dauer = $_SESSION['dauer'];
  $menge = 1;
  $objid = $_POST['submit'];
  $status = 1;

  $stmt = $pdo->prepare('insert into Mietauftrag (Reservationsdatum, Startdatum, Dauer, Menge, BenutzerFK, MietobjektFK, StatusFK) ' .
                        'values (:rd, :sd, :dr, :mg, :uid, :mo, :st)');
  $stmt->execute([':rd' => $resdat, ':sd' => $start, ':dr' => $dauer, ':mg' => $menge, ':uid' => $userid, ':mo' => $objid, ':st' => $status]);
  $pdo->commit();
} else {
  echo "Hat nicht funktioniert";
}

drawPageHead('Mietauswahl');
drawNavbar(isset($_SESSION['username']), );
drawMietabschlussView();
drawFooter();
drawPageFoot();
?>