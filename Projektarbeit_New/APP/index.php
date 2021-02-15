<?php
session_start();

require_once 'requireAll.inc.php';

if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = '';
}

drawPageHead('Startseite');
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawLandingPageView();
drawFooter();
drawPageFoot();
?>