<?php
  require '../Core/database.inc.php';

  function login_check($username, $password) : bool
  {
    global $errors;
    $pdo = connect();
    
    $exists = false;

    // Prepares the sql command
    $stmt = $pdo->prepare("select passwort from benutzer where benutzername = :username");

    // Executes the command that we prepared. we change the key/placeholder with our $ variable
    $stmt->execute([':username' => $username]);

    // Fetches the results from the database
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    

    
    if ($result == true)
    {
        // If the password verification is correct the $exists is true. that lets us continue to the website
        $exists = password_verify($password, $result['passwort']);
        if (!$exists)
            $errors[] = "Passwort falsch!";
    } else {
        $errors[] = "Benutzer existiert nicht!";
    }
    return $exists;

  }



?>
