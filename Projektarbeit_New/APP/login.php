<?php
session_start();

require_once 'requireAll.inc.php';

if (isset($_SESSION['username'])) { ?>
  <meta http-equiv="refresh" content="0; URL=." />
<?php }
if (isset($_POST['submit'])) {
  $pdo = Database::connect();
  
}

drawPageHead('Startseite');
drawNavbar(isset($_SESSION['username']));
drawAnmeldenView();
drawFooter();
drawPageFoot();
?>