<?php
session_start();

require_once 'requireAll.inc.php';

drawPageHead('Mietformular');
drawNavbar(isset($_SESSION['username']));
drawMietformularView();
drawFooter();
drawPageFoot();
?>