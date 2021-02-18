<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$delete = false;
$redir = null;
$index = 0;
$objtypen = [];

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();
  if (isset($_POST['edit'])) {
    $id = $_POST['edit'];

    $stmt = $pdo->prepare('select * from Mietauftrag where MietauftragID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');

    $delete = false;
  } else if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $stmt = $pdo->prepare('select * from Mietauftrag where MietauftragID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');

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

    $stmt = $pdo->prepare('select * from Mietauftrag where MietauftragID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');

    $delete = false;
  } else {
    $redir = 'warenkorb.php';
  }
  $pdo->commit();
}

drawPageHead($delete ? 'Mietauftrag löschen' : 'Mietauftrag bearbeiten', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
if ($delete) {
  drawDeleteMietauftragView($_SESSION['isWarenkorb'], $index);
} else {
  drawEditMietauftragView(  $objtypen, $_SESSION['isWarenkorb'] );
}
drawFooter();
drawPageFoot();
?>