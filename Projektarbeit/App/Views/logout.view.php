<?php require "../Controllers/logout.logik.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <title>Startseite | Jetstream-Service</title>

    <meta http-equiv="Refresh" content="3; url='..'" />
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="..">Startseite</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./anmeldung.view.php">Anmeldung</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./kontakt.view.php">Kontakt</a>
            </li>
          </ul>
          <ul class="navbar-nav mr-0 my-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./login.view.php">Einloggen</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="./register.view.php">Registrieren <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <h1>Logout erfolgreich!</h1>
      <p>Der Logout war erfolgreich.</p>
      <p>Sie werden in Kürze zur Startseite weitergeleitet.</p>
    </div>
  </body>
</html>