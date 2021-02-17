<?php
session_start();

require_once 'requireAll.inc.php';

$redir = null;
$user = null;
$raenge = [];
$canPromote = false;
$errors = [];

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  if (isset($_POST['submit'])) {
    $vn = trim($_POST['Vorname']);
    $nn = trim($_POST['Nachname']);
    $em = trim($_POST['email']);
    $tl = trim($_POST['tel']);
    $pw = $_POST['Passwort'];
    $pwwh = $_POST['PasswortWiederh'];

    // Überprüfung der angegebenen Werte
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

    if (empty($errors)) {
      $sql = 'update Benutzer set Vorname = :vn, Nachname = :nn, Email = :em, Telefon = :tel, RangFK = :rang ';
      if (isset($_POST['edit'])) {
        $sql .= 'where BenutzerID = :uid';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':uid' => $_POST['edit']]);
      } else {
        $sql .= 'where Email = :em';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':em' => $_SESSION['username']]);
      }
    }

    if (isset($_POST['pwalt'])) {
      
      if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pw)) {
        $errors[] = "Passwort muss Grossbuchstaben, Kleinbuchstaben und Zahlen beinhalten und mindestens 8 Zeichen lang sein!";
      }
      if ($pw != $pwwh) {
        $errors[] = 'Passwörter müssen übereinstimmen!';
      }
    }
  }

  $stmt = null;
  $sql = 'select * from Benutzer ';
  if (isset($_POST['edit'])) {
    $sql .= 'where BenutzerID = :uid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':uid' => $_POST['edit']]);
    if ($_SESSION['berechtigung'] > 1) {
      $canPromote = true;
    }
  } else {
    $sql .= 'where Email = :em';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':em' => $_SESSION['username']]);
  }
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer');
  $user = $stmt->fetch();

  $stmt = $pdo->prepare('select * from Rang');
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Rang');
  $raenge = $stmt->fetchAll();

  $pdo->commit();
} else {
  $redir = 'login.php?redirect=profileOptions.php';
  $user = new Benutzer();
}

drawPageHead('Profile Options', $redir);
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawProfileOptionsView($user, $raenge, $canPromote, isset($_POST['submit']), $errors);
drawFooter();
drawPageFoot();