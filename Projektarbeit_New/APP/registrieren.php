<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];

$vn = '';
$nn = '';
$em = '';
$tl = '';
$pw = '';
$pwwh = '';

if (isset($_SESSION['username'])) { ?>
  <meta http-equiv="refresh" content="0; url='.'" />
<?php }

if (isset($_POST['submit'])) {
  $vn = trim($_POST['Vorname']);
  $nn = trim($_POST['Nachname']);
  $em = trim($_POST['email']);
  $tl = trim($_POST['tel']);
  $pw = $_POST['Passwort'];
  $pwwh = $_POST['PasswortWiederh'];

  if ($vn == '') {
    $errors[] = 'Vorname darf nicht leer sein!';
  }
  if ($nn == '') {
    $errors[] = 'Nachname darf nicht leer sein!';
  }
  if ($em == '') {
    $errors[] = 'Email darf nicht leer sein!';
  }
  if ($tl == '') {
    $tl = null;
  } else if (!preg_match("/0[0-9]{2}[-\/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}/", $tl)) {
    $errors[] = "Telefonnummer muss gültig sein!";
  }
  if ($pw == '') {
    $errors[] = 'Passwort darf nicht leer sein!';
  }
  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pw)) {
    $errors[] = "Passwort muss Grossbuchstaben, Kleinbuchstaben und Zahlen beinhalten und mindestens 8 Zeichen lang sein!";
  }
  if ($pw != $pwwh) {
    $errors[] = 'Passwörter müssen übereinstimmen!';
  }

  $pdo = Database::connect();
  $stmt = $pdo->prepare('select BenutzerID from benutzer where email = :em');
  $stmt->execute([':em' => $em]);
  if (count($stmt->fetchAll()) > 0) {
    $errors[] = 'Benutzer existiert bereits!';
  }
}

drawPageHead('Registrieren');
drawNavbar(isset($_SESSION['username']));

if (isset($_POST['submit'])) {
  if (count($errors) == 0) {
    $stmt = $pdo->prepare('insert into benutzer (Vorname,Nachname,Passwort,Telefon,Email,RangFK) values (:vn,:nn,:pw,:tl,:em,1);');
    $stmt->execute([':vn' => $vn, ':nn' => $nn, ':pw' => password_hash($pw, PASSWORD_DEFAULT), ':tl' => $tl, ':em' => $em]);
  }
}

drawRegistrierenView(isset($_POST["submit"]), $errors, $vn, $nn, $em, $tl);
drawFooter();
drawPageFoot();
?>