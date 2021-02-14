<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];
$redir = '';
$objtypen = [];

if (isset($_SESSION['username'])) {
  $pdo = Database::connect($_SESSION['berechtigung']);
  $stmt = $pdo->prepare('select * from Mietobjekttyp');
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietobjekttyp');
  $objtypen = $stmt->fetchAll();

  if (isset($_POST['submit'])) {
    $objtyp = $_POST['objtyp'];
    $groesse = $_POST['groesse'];
    $gesch = $_POST['gesch'];
    $alter = $_POST['alter'];
    $start = $_POST['start'];
    $startdat = date_create($start);
    $ende = $_POST['ende'];
    $endedat = date_create($ende);
    $dauerint = date_diff($startdat, $endedat);
    $dauerzahl = $dauerint->days == false ? $dauerint->d : $dauerint->days;

    if ($groesse < 80 || $groesse > 250) {
      $errors[] = 'Wir haben nur Geräte für Körpergrössen zwischen 80 und 250cm!';
    }

    $geschlter = ['m', 'w', 'd', 'u'];
    if (!in_array($gesch, $geschlter)) {
      $error = 'Geschlecht  ist ungültig! Gültig sind nur: ';
      foreach ($geschlter as $e) {
        $error .= $e . ', ';
      }
      $error = substr($error, 0, strlen($error) - 2) . '!';
      $errors[] = $error;
    }

    $algrpn = ['Kind', 'Jugendlich', 'Erwachsen'];
    if (!in_array($alter, $algrpn)) {
      $error = 'Altersgruppe ist ungültig! Gültig sind nur: ';
      foreach ($algrpn as $e) {
        $error .= $e . ', ';
      }
      $error = substr($error, 0, strlen($error) - 2) . '!';
      $errors[] = $error;
    }

    if ($dauerzahl > 28) {
      $errors[] = 'Maximale Ausleihzeit beträgt 4 Wochen!';
    }
    if ($startdat > $endedat) {
      $errors[] = 'Enddatum darf nicht vor Startdatum liegen!';
    }

    if (empty($errors)) {
      $redir = 'mietauswahl.php';
      $_SESSION['groesse'] = $groesse;
      $_SESSION['gesch'] = $gesch;
      $_SESSION['alter'] = $alter;
      $_SESSION['start'] = $start;
      $_SESSION['dauer'] = $dauerzahl;
      $_SESSION['objtyp'] = $objtyp;
    }
  }
}



drawPageHead('Mietformular',
  isset($_SESSION['username']) ? (
    (isset($_POST['submit']) && empty($errors)) ? $redir : null
  ) : 'login.php?redirect=mietformular.php');
drawNavbar(isset($_SESSION['username']));
drawMietformularView(isset($_POST['submit']), $errors, $objtypen);
drawFooter();
drawPageFoot();
?>