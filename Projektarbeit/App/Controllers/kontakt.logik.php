<?php
  session_start();
  if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    
    require_once '../Core/access-users.inc.php';
    $accessUsers = accessUsers($username);
  }
?>