<?php
session_start();

require_once 'requireAll.inc.php';
$prioritaeten = [];
$serviceobjekte = [];
$servicestati = [];
$serviceauftrag = new Serviceauftrag();
$delete = false;
$redir = null;
$id = 0;

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $stmt = $pdo->prepare('select * from Serviceauftrag where ServiceauftragID = :id');
    $stmt->execute([':id' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Serviceauftrag');
    $serviceauftrag = $stmt->fetch();

    $stmt = $pdo->prepare('select * from Prioritaet');
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Prioritaet');
    $prioritaeten = $stmt->fetchAll();
    
    $stmt = $pdo->prepare('select * from Serviceobjekt');
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Serviceobjekt');
    $serviceobjekte = $stmt->fetchAll();
    
    $stmt = $pdo->prepare('select * from Servicestatus');
    $stmt->execute([]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Servicestatus');
    $servicestati = $stmt->fetchAll();
    
    $delete = false;
  } else if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $delete = true;
  } else if (isset($_POST['editsubmit'])) {
    $so = $_POST['Servicetyp'];
    $pr = $_POST['prio'];
    $id = $_POST['editsubmit'];

    $sql = 'update Serviceauftrag set ServiceobjektFK = :so, PrioFK = :pr';
    $parArray = [
      ':so' => $so,
      ':pr' => $pr,
      ':said' => $id
    ];
    if (isset($_POST['status'])) {
      $sql .= ', Status = :st';
    }
    $sql .= ' where ServiceauftragID = :said';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($parArray);
    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';
  } else if (isset($_POST['deleteconfirm'])) {
    $id = $_POST['deleteconfirm'];

    $stmt = $pdo->prepare('select * from Benutzer_Serviceauftrag where SAID = :maid');
    $stmt->execute([':maid' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Serviceauftrag');
    if ($auftrag = $stmt->fetch()) {
      if ($auftrag->anzInWk) {
        $stmt = $pdo->prepare('delete from Serviceauftrag where ServiceauftragID = :maid');
      } else {
        $stmt = $pdo->prepare('update Serviceauftrag set StatusFK = 7 where ServiceauftragID = :maid');
      }
    }
    $stmt->execute([':maid' => $id]);
    var_dump($stmt->errorInfo());
    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';

    $delete = true;
  } else {
    $redir = $_SESSION['isWarenkorb'] ? 'warenkorb.php' : 'auftragsliste.php';
  }
  $pdo->commit();
}
drawPageHead('Mietauftrag bearbeiten', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
if ($delete) {
  drawDeleteAuftragView($_SESSION['isWarenkorb'], $id);
} else {
  drawEditServiceauftragView($serviceobjekte, $prioritaeten, $servicestati, $serviceauftrag);
}
drawFooter();
drawPageFoot();
?>