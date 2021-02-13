<?php
session_start();

require_once 'requireAll.inc.php';

drawPageHead('Service');
drawNavbar(isset($_SESSION['username']));
drawServiceView();
drawFooter();
drawPageFoot();
?>