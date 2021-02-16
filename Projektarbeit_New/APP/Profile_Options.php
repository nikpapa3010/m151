<?php
session_start();

require_once 'requireAll.inc.php';



drawPageHead('Profile Options');
drawNavbar(isset($_SESSION['username']), $_SESSION['name']);
drawProfileOptionsView();
drawFooter();
drawPageFoot();