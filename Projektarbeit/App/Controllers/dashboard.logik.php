<?php
  session_start();
  if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    
    require_once '../Core/access-users.inc.php';
    $accessUsers = accessUsers($username);
  } else {
    echo "<script type='text/javascript'>window.location='login.php'</script>";
  }

  require_once '../Core/helpers.inc.php';

  // Verbindung aufnehmen 
  require_once '../Core/database.inc.php';
  $pdo = connect();

  // überprüfen ob alle angezeigt werden dürfen
  require_once '../Core/access-users.inc.php';
  $showAll = accessUsers($username);

  // Änderungen speichern
  if (isset($_POST["submit"]))
  {
    foreach ($_POST as $p) {
      $val = trim($p);
      $id = array_keys($_POST, $p)[0];

      // SQL Befehl mit benannten Parametern
      $sql = "update Auftrag set StatusID = :val where AuftragID = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([":val" => $val, ":id" => $id]);

      unset($_POST[$id]);
    }
  }
?>