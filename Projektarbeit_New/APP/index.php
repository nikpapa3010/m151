<?php
session_start();

require_once 'requireAll.inc.php';

drawPageHead('Startseite');
drawNavbar(isset($_SESSION['username']));
drawLandingPageView();
drawFooter();
drawPageFoot();
?>