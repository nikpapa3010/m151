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
  $stmt = $pdo->prepare('select Passwort from benutzer where Email = :em');
  $stmt->execute([':em' => $em]);
  
  if ($pwh = $stmt->fetchColumn(0)) {
    if (password_verify($pw, $pwh)) {
      $_SESSION['username'] = $em;
      $stmt = $pdo->prepare('select Berechtigung, concat(Vorname, " ", Vorname) as Name from rang inner join benutzer on RangFK = RangID where Email = :un');
      $stmt->execute([':un' => $_SESSION['username']]);
      $res = $stmt->fetch(PDO::FETCH_NUM);
      $_SESSION['berechtigung'] = $res[0];
      $_SESSION['name'] = $res[1];
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