<?php
  session_start();
?>

<?php if (isset($_SESSION["username"])) {?>
  <meta http-equiv="refresh" content="0; url=../">
<?php } ?>

<?php
  require '../Core/helpers.inc.php';

  // Verbindung aufnehmen 
  require '../Core/database.inc.php';
  $pdo = connect();

  if (isset($_POST["submit"]))
  {
    $errors = [];
    $un = postAndTrim("username");
    $vn = postAndTrim("vorname");
    $nn = postAndTrim("nachname");
    $em = postAndTrim("email");
    $tl = postAndTrim("tel");
    $pw = postAndTrim("Passwort");
    $pww = postAndTrim("PasswortWiederh");

    if ($un == "") {
      $errors[] = "Benutzername darf nicht leer sein!";
    }
    $stmt = $pdo->prepare("select Benutzername, Email from allebenutzer;");
    $stmt->execute();
    while ($r = $stmt->fetch()) {
      if ($r["Benutzername"] == $un || $r["Email"] == $em) {
        if ($r["Benutzername"] == $un) {
          $errors[] = "Benutzername existiert bereits!";
        }
        if ($r["Email"] == $em) {
          $errors[] = "Email-Adresse existiert bereits!";
        }
        break;
      }
    }
    if ($vn == "") {
      $errors[] = "Vorname darf nicht leer sein!";
    }
    if ($nn == "") {
      $errors[] = "Nachname darf nicht leer sein!";
    }
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "$em ist keine gültige Email-Adresse!";
    }
    if (!preg_match("/0[0-9]{2}[-\/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}/", $tl)) {
      $errors[] = "$tl ist keine gültige Telefonnummer!";
    }
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pw)) {
      $errors[] = "Passwort muss Grossbuchstaben, Kleinbuchstaben und Zahlen beinhalten und mindestens 8 Zeichen lang sein!";
    }
    if ($pw != $pww) {
      $errors[] = "Die Passwörter stimmen nicht überein!";
    }

    if (empty($errors)) {
      $stmt = $pdo->prepare("insert into benutzer(Benutzername, Nachname, Vorname, Passwort, Email, Telefonnummer, RangID)
                            values(:un, :nn, :vn, :pw, :em, :tl, 1)");
      
      $pw = password_hash($pw, PASSWORD_DEFAULT);
      if(!$stmt->execute([":un" => $un, ":nn" => $nn, ":vn" => $vn, ":pw" => $pw, ":em" => $em, ":tl" => $tl])) {
        $errors[] = "Beim Einfügen in die Datenbank ist ein Fehler aufgetreten.";
      }
    }
  }
?>