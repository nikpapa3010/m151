<?php
session_start();

require_once 'requireAll.inc.php';

drawPageHead('Warenkorb');
drawNavbar(isset($_SESSION['username']));
drawWarenkorbView();
drawFooter();
drawPageFoot();
?>
