<?php
session_start();

require_once 'requireAll.inc.php';

$errors = [];
if (isset($_SESSION['username'])) { ?>
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
    }
    $errors[] = 'Passwort ist nicht korrekt!';
  } else {
    $errors[] = 'Benutzer existiert nicht!';
  }
}

drawPageHead('Login');
drawNavbar(isset($_SESSION['username']));
drawLoginView(isset($_POST['submit']), $errors);
drawFooter();
drawPageFoot();
?>