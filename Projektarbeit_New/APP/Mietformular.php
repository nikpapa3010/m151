<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];

if (!isset($_SESSION['username'])) { ?>

<?php }

if (isset($_POST['submit'])) {
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
  }
}



drawPageHead('Mietformular', isset($_SESSION['username']) ? null : 'login.php?redirect=mietformular.php');
drawNavbar(isset($_SESSION['username']));
drawMietformularView(isset($_POST['submit']), $errors);
drawFooter();
drawPageFoot();
?>