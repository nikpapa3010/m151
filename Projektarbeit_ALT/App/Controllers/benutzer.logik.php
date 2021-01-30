<?php
  session_start();

  require '../Core/helpers.inc.php';

  // Verbindung aufnehmen 
  require '../Core/database.inc.php';
  $pdo = connect();

  if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // überprüfen ob alle Aufträge angezeigt werden dürfen
    require_once '../Core/access-users.inc.php';
    $showAll = accessUsers($username);
    
    if (!$showAll) {
      echo "<script type='text/javascript'>window.location='login.view.php'</script>";
    }
  } else {
    echo "<script type='text/javascript'>window.location='login.view.php'</script>";
  }

  // Änderungen speichern
  if (isset($_POST["submit"]))
  {
    foreach ($_POST as $p) {
      $val = trim($p);
      $id = array_keys($_POST, $p)[0];

      // SQL Befehl mit benannten Parametern
      $sql = "update Benutzer set RangID = :val where UserID = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([":val" => $val, ":id" => $id]);

      unset($_POST[$id]);
    }
  }
?>