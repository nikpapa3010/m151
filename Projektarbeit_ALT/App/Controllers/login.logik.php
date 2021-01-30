<?php
  session_start();
  include '../Repository/usersrepository.inc.php';
  
  // Falls Aufruf von Login-Seite
  if($_SERVER['REQUEST_METHOD'] === 'POST') 
  {  
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      // Zugangsdaten einlesen
      $username = $_POST["username"];
      $password = $_POST["password"];
      
      // Ist der Zugang korrekt
      if(login_check($username, $password))         
      {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username; 

        // Geschützte Seite öffnen
        echo "<script type='text/javascript'>window.location='..'</script>";
      }
    }
  } else if (isset($_SESSION['username'])) {
    echo "<script type='text/javascript'>window.location='..'</script>";
  }
?>