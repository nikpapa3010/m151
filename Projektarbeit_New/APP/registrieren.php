<?php
session_start();

require_once 'requireAll.inc.php';

if (isset($_POST['submit'])) {
  $vn = trim($_POST['Vorname']);
  $nn = trim($_POST['Nachname']);
  $em = trim($_POST['email']);
  $tl = trim($_POST['tel']);
  $pw = trim($_POST['Passwort']);
  $pwwh = trim($_POST['PasswortWiederh']);

  $pdo = Database::connect();
  $stmt = $pdo->prepare('CALL Createuser(:vn,:nn,:pw,:tl,:em, 1, "");');
}

drawPageHead('Registrieren');
drawNavbar(isset($_SESSION['username']));
drawRegistrierenView();
drawFooter();
drawPageFoot();
?>