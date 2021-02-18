<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$delete = false;
$redir = null;

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
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

    $delete = true;
  } else if (isset($_POST['deleteconfirm'])) {
    $id = $_POST['deleteconfirm'];

    $stmt = $pdo->prepare('select * from Mietauftrag where MietauftragID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietauftrag');

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
}

drawPageHead($delete ? 'Mietauftrag löschen' : 'Mietauftrag bearbeiten', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
if ($delete) {
} else {
}
drawFooter();
drawPageFoot();
?>