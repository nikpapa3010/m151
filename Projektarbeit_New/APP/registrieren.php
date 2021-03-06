<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$errors = [];

$vn = '';
$nn = '';
$em = '';
$tl = '';
$pw = '';
$pwwh = '';

if (isset($_SESSION['username']) && $_SESSION['berechtigung'] > 0) { ?>
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
  $pdo->beginTransaction();
  $stmt = $pdo->prepare('select BenutzerID from benutzer where email = :em');
  $stmt->execute([':em' => $em]);
  if (count($stmt->fetchAll()) > 0) {
    $errors[] = 'Benutzer existiert bereits!';
  }
  
  if (empty($errors)) {
    $stmt = $pdo->prepare('call Createuser(:vn,:nn,:pw,:tl,:em);');
    $stmt->execute([':vn' => $vn, ':nn' => $nn, ':pw' => password_hash($pw, PASSWORD_DEFAULT), ':tl' => $tl, ':em' => $em]);
    $_SESSION['username'] = $em;
    $stmt = $pdo->prepare('select * from Benutzer_Berechtigung where Email = :em');
    $stmt->execute([':em' => $em]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Berechtigung');
    $benber = $stmt->fetch();
    $_SESSION['berechtigung'] = $benber->Berechtigung;
    $_SESSION['name'] = $benber->Name;
  }
  $pdo->commit();
}

drawPageHead('Registrieren');
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawRegistrierenView(isset($_POST["submit"]), $errors, isset($_GET['redirect']) ? $_GET['redirect'] : '.');
drawFooter();
drawPageFoot();
?>