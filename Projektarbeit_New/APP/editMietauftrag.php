<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$delete = false;
$redir = null;
$index = 0;
$mietstati = [];
$mietauftrag = new Mietauftrag();

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  $stmt = $pdo->prepare('select * from Mietstatus');
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietstatus');
  $mietstati = $stmt->fetchAll();

  if (isset($_POST['edit'])) {
    $id = $_POST['edit'];

    $stmt = $pdo->prepare('select * from Mietauftrag where MietauftragID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');
    $mietauftrag = $stmt->fetch();

    $delete = false;
  } else if (isset($_POST['delete'])) {
    $index = $_POST['delete'];
    $delete = true;
  } else if (isset($_POST['deleteconfirm'])) {
    $id = $_POST['deleteconfirm'];

    $stmt = $pdo->prepare('select * from Benutzer_Mietauftrag where MAID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Mietauftrag');
    if ($auftrag = $stmt->fetch()) {
      if ($auftrag->anzInWk) {
        $stmt = $pdo->prepare('delete from mietauftrag where MietauftragID = :maid');
      } else {
        $stmt = $pdo->prepare('update Mietauftrag set StatusFK = 7 where MietauftragID = :maid');
      }
    }
    $stmt->execute([':maid' => $id]);
    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';

    $delete = true;
  } else if (isset($_POST['editsubmit'])) {
    $id = $_POST['editsubmit'];

    $startdat = date_create($_POST['start']);
    $endedat = date_create($_POST['ende']);

    $sql = 'update Mietauftrag set Startdatum = :sd, Dauer = :dr, Menge = :mg';
    $parArray = [
      ':sd' => $_POST['start'],
      ':dr' => date_diff($startdat, $endedat)->days,
      ':mg' => $_POST['menge'],
      ':maid' => $id
    ];
    if (isset($_POST['status'])) {
      $sql .= ', Status = :st';
      $parArray[':st'] = $_POST['status'];
    }
    $sql .= ' where MietauftragID = :maid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parArray);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');

    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';
    $delete = false;
  } else {
    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';
  }
  $pdo->commit();
}

drawPageHead($delete ? 'Mietauftrag löschen' : 'Mietauftrag bearbeiten', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
if ($delete) {
  drawDeleteAuftragView($_SESSION['isWarenkorb'], $index);
} else {
  drawEditMietauftragView($mietstati, $mietauftrag);
}
drawFooter();
drawPageFoot();
?>