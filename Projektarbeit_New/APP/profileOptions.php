<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$redir = null;
$user = null;
$raenge = [];
$canPromote = false;
$errors = [];
$submitValue = null;
$showOldPw = true;

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $pdo->beginTransaction();

  if (isset($_POST['submit'])) {
    // Post-Variablen setzen
    $vn = trim($_POST['Vorname']);
    $nn = trim($_POST['Nachname']);
    $em = trim($_POST['email']);
    $tl = trim($_POST['tel']);
    $rg = null;
    if (isset($_POST['rang'])) {
      $rg = $_POST['rang'];
    }
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
    if (!is_numeric($_POST['submit'])) {
      // Passwort muss eingegeben werden, wenn kein fremdes Konto bearbeitet wird
      if (isset($_POST['pwalt']) && $_POST['pwalt'] != '') {
        $stmt = $pdo->prepare('select * from Benutzer_Berechtigung where Email = :em');
        $stmt->execute([':em' => $_POST['submit']]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Berechtigung');
        $benber = $stmt->fetch();
        if (!password_verify($_POST['pwalt'], $benber->Passwort)) {
          $errors[] = 'Das alte Passwort ist falsch!';
        }
      } else {
        $errors[] = 'Bitte geben Sie ihr altes Passwort ein!';
      }
    }

    // wenn keine Fehler vorhanden
    if (empty($errors)) {
      // Benutzerdaten aktualisieren
      $sql = 'update Benutzer set Vorname = :vn, Nachname = :nn, Email = :em, Telefon = :tel';
      $parArray = [':vn' => $vn, ':nn' => $nn, ':em' => $em, ':tel' => $tl];
      if (isset($rg)) {
        $sql .= ', RangFK = :rg';
        $parArray[':rg'] = $rg;
      }
      if (is_numeric($_POST['submit'])) {
        $sql .= ' where BenutzerID = :uid';
      } else {
        $sql .= ' where Email = :uid';

        // E-Mail in der Session aktualisieren
        $_SESSION['username'] = $em;
      }
      $parArray[':uid'] = $_POST['submit'];
      $stmt = $pdo->prepare($sql);
      $stmt->execute($parArray);

      // Bei dessen Änderung Passwort überprüfen
      if ((isset($pw) && $pw != '') || (isset($pwwh) && $pwwh != '')) {
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pw)) {
          $errors[] = "Passwort muss Grossbuchstaben, Kleinbuchstaben und Zahlen beinhalten und mindestens 8 Zeichen lang sein!";
        }
        if ($pw != $pwwh) {
          $errors[] = 'Passwörter müssen übereinstimmen!';
        }

        if (empty($errors)) {
          $sql = 'update Benutzer set Passwort = :pw where Email = :em';
          $parArray = [':pw' => password_hash($pw, PASSWORD_DEFAULT), ':em' => $em];
          $stmt = $pdo->prepare($sql);
          $stmt->execute($parArray);
        }
      }

      if (empty($errors)) {
        if (is_numeric($_POST['submit'])) {
          $redir = 'login.php?redirect=benutzerliste.php';
        } else {
          $redir = 'login.php?redirect=profileOptions.php';
        }
      }
    }
  }

  $stmt = null;
  $sql = 'select * from Benutzer ';
  if (isset($_POST['edit'])) {
    if ($_SESSION['berechtigung'] > 0) {
      $sql .= 'where BenutzerID = :uid';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':uid' => $_POST['edit']]);
      if ($_SESSION['berechtigung'] > 1) {
        $canPromote = true;
      }
      $submitValue = $_POST['edit'];
      $showOldPw = false;
    } else {
      $redir = 'profileOptions.php';
    }
  } else {
    $sql .= 'where Email = :em';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':em' => $_SESSION['username']]);

    $submitValue = $_SESSION['username'];
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
drawProfileOptionsView($user, $raenge, $canPromote, isset($_POST['submit']), $errors, $submitValue, $showOldPw);
drawFooter();
drawPageFoot();