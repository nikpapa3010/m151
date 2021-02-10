<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];

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
  }
  if ($pw == '') {
    $errors[] = 'Passwort darf nicht leer sein!';
  }
  if ($pw != $pwwh) {
    $errors[] = 'Passwörter müssen übereinstimmen!';
  }

  $pdo = Database::connect();
  $stmt = $pdo->prepare('select BenutzerID from benutzer where email = :em');
  $stmt->execute([':em' => $em]);
  if (count($stmt->fetchAll()) > 0) {
    throw new UnexpectedValueException('Benutzer existiert bereits!');
  }

  if (count($errors) == 0) {
    $stmt = $pdo->prepare('insert into benutzer (Vorname,Nachname,Passwort,Telefon,Email,RangFK) values (:vn,:nn,:pw,:tl,:em,1);');
    $stmt->execute([':vn' => $vn, ':nn' => $nn, ':pw' => $pw, ':tl' => $tl, ':em' => $em]);
    echo 'Erfolgreich!';
  } else {
    foreach ($errors as $e) {
      echo $e . '<br />';
    }
  }


}

drawPageHead('Registrieren');
drawNavbar(isset($_SESSION['username']));
drawRegistrierenView();
drawFooter();
drawPageFoot();
?>