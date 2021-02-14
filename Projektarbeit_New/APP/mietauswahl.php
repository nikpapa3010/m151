<?php
session_start();

require_once 'requireAll.inc.php';

$redir = null;
$mietobjekte = [];

if (isset($_SESSION['groesse']) && isset($_SESSION['gesch']) && isset($_SESSION['alter']) &&
    isset($_SESSION['start']) && isset($_SESSION['dauer']) && isset($_SESSION['objtyp'])) {
  if (isset($_SESSION['username'])) {
    $groesse = $_SESSION['groesse'];
    $gesch = $_SESSION['gesch'];
    $alter = $_SESSION['alter'];
    $start = $_SESSION['start'];
    $dauer = $_SESSION['dauer'];
    $objtyp = $_SESSION['objtyp'];

    $pdo = Database::connect($_SESSION['berechtigung']);
    $sql = 'select * from Mietobjekte ' .
           'where KoerpergroesseVon <= :gr and KoerpergroesseBis >= :gr ' .
           'and Geschlecht = :gs and Altersgruppe = :al and ObjekttypID = :ot';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':gr' => $groesse, ':gs' => $gesch, ':al' => $alter, ':ot' => $objtyp]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mietobjekte');
    $mietobjekte = $stmt->fetchAll();
  } else {
    $redir = 'login.php?redirect=mietformular.php';
  }
} else {
  $redir = 'mietformular.php';
}

drawPageHead('Mietauswahl', $redir);
drawNavbar(isset($_SESSION['username']));
drawMietauswahlView($mietobjekte);
drawFooter();
drawPageFoot();
?>