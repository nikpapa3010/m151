<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

$errors = [];
if (isset($_SESSION['username']) && !isset($_POST['submit'])) { ?>
  <meta http-equiv="refresh" content="0; url='.'" />
<?php }

if (isset($_POST['submit'])) {
  $em = $_POST['username'];
  $pw = $_POST['password'];
  $pdo = Database::connect();
  $stmt = $pdo->prepare('select * from Benutzer_Berechtigung where Email = :em');
  $stmt->execute([':em' => $em]);
  $stmt->setFetchMode(PDO::FETCH_CLASS, 'Benutzer_Berechtigung');
  
  if ($benber = $stmt->fetch()) {
    $pwh = $benber->Passwort;
    if (password_verify($pw, $pwh)) {
      $_SESSION['username'] = $em;
      $_SESSION['berechtigung'] = $benber->Berechtigung;
      $_SESSION['name'] = $benber->Name;
    } else {
      $errors[] = 'Passwort ist nicht korrekt!';
    }
  } else {
    $errors[] = 'Benutzer existiert nicht!';
  }
}

drawPageHead('Login');
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawLoginView(isset($_POST['submit']), $errors, isset($_GET['redirect']) ? $_GET['redirect'] : '.');
drawFooter();
drawPageFoot();
?>