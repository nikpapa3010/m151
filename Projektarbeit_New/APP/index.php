<?php
session_start();

include 'view/head.view.php';
if (isset($_SESSION['username'])) {
  include 'view/navbar-loggedin.view.php';
} else {
  include 'view/navbar-loggedout.view.php';
}
include 'view/landingpage.view.php';
include 'view/footer.php';
?>