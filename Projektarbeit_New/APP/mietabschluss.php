<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$redir = null;

if (isset($_SESSION['username']) && isset($_POST['submit'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  $resdat = date_format(date_create(), 'Y-m-d');
  $start = $_SESSION['start'];
  $dauer = $_SESSION['dauer'];
  $menge = $_SESSION['menge'];
  $objid = $_POST['submit'];
  $status = 1;

  $stmt = $pdo->prepare('call PMietauftrag(:rd, :sd, :dr, :mg, :em, :mo, :st)');
  $stmt->execute([':rd' => $resdat, ':sd' => $start, ':dr' => $dauer, ':mg' => $menge,
    ':em' => $_SESSION['username'], ':mo' => $objid, ':st' => $status]);
  $pdo->commit();
  $redir = 'warenkorb.php';
} else {
  $redir = 'mietformular.php';
}

drawPageHead('Mietauswahl', $redir, 3);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawMietabschlussView();
drawFooter();
drawPageFoot();
?>