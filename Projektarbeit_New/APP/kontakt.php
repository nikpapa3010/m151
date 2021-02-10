<?php
session_start();

require_once 'requireAll.inc.php';

drawPageHead('Kontakt');
drawNavbar(isset($_SESSION['username']));
drawKontaktView();
drawFooter();
drawPageFoot();
?>