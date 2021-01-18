<?php
  session_start();
  if (isset($_SESSION["username"])) {
    $un = $_SESSION["username"];
    
    require_once '../Core/access-users.inc.php';
    $accessUsers = accessUsers($un);
  } else {
    echo "<script type='text/javascript'>window.location='login.view.php'</script>";
  }

  require_once '../Core/helpers.inc.php';


  // Verbindung aufnehmen 
  require_once '../Core/database.inc.php';
  $pdo = connect();

  if (isset($_POST["submit"])) {
    $pr = postAndTrim("pr");
    $di = postAndTrim("di");
    $sd = date("Y-m-d");

    // AuftraggeberID abrufen
    $agidstmt = $pdo->prepare("select UserID from Benutzer where Benutzername = :un");
    $ag = 0;
    if ($agidstmt->execute([":un" => $un])) {
      $ag = $agidstmt->fetch()["UserID"];
    }

    $errors = [];

    if (!empty($errors)) {
      echo "<ul class=\"alert alert-danger\">";
        foreach ($errors as $e) {
          echo "<li>$e</li>";
        }
      echo "</ul>";
    } else {
      // SQL Befehl mit benannten Parametern
      $sql = "insert into Auftrag(StartDatum, PrioID, DienstID, StatusID, AuftraggeberID)
              values(:sd, :pr, :di, 1, :ag);";

      $stmt = $pdo->prepare($sql);

      // Werte zu benannten Parametern zuweisen
      $person = array(':ag' => $ag, ':pr' => $pr, ':di' => $di, ':sd' => $sd);

      // Befehl ausführen
      if ($stmt->execute($person))
      { 
        $sqlprio = "select * from Prioritaet where PrioID = $pr;";
        $prio = $pdo->query($sqlprio);
        $prio->setFetchMode(PDO::FETCH_ASSOC);
        
        $r = $prio->fetch();
        $days = $r["totalTage"];
        $date = date_create($sd);
        date_add($date, date_interval_create_from_date_string("$days days"));
        echo "<p><font color='#00aa00'>";
        echo "Es wurde eine Bestellung hinzugefügt <br />";
        echo "Ihre bestellung wird am " . date_format($date, "d.m.Y") . " fertig sein";
        echo "</font></p>";
      }
      else
      {
        echo "<p><font color='#ff0000'>";
        echo "Es ist ein Fehler aufgetreten, ";
        echo "es wurde kein Datensatz hinzugefügt";
        echo "</font></p>";
      }
    }
  }
?>
