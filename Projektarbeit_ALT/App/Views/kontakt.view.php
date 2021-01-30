<?php require "../Controllers/kontakt.logik.php" ?>
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
    
    <title>Kontakt | Jetstream-Service</title>
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
              <a class="nav-link" href="..">Startseite</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./anmeldung.view.php">Anmeldung</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="./kontakt.view.php">Kontakt <span class="sr-only">(current)</a>
            </li>
          </ul>
          <ul class="navbar-nav mr-0 my-lg-0">
            <?php if (isset($_SESSION["username"])) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo htmlspecialchars($_SESSION["username"]) ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./dashboard.view.php">Dashboard</a>
                  <?php if ($accessUsers) { echo '<a class="dropdown-item" href="./benutzer.view.php">Benutzer</a>'; } ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./logout.view.php">Ausloggen</a>
                </div>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link" href="./login.view.php">Einloggen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./register.view.php">Registrieren</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </nav>
      <h1>Kontakt</h1>
      <h2>Adresse</h2>
      <p>
        Jetstream-Service GmbH <br>
        Bünzlistrasse 69 <br>
        CH-4200 Gagglisberg
      </p>
      <h2>Telefon</h2>
      <p>069 420 13 37</p>
      <h2>Anfahrt</h2>
      <h3>Mit dem öV</h3>
      <p>Von Bern aus gibt es stündlich eine Regionalzugverbindung nach Gagglisberg. Unsere Filiale befindet sich direkt vis-à-vis vom Bahnhof.</p>
      <h3>Mit dem Auto</h3>
      <p>Von Bern aus fahren Sie auf der Autobahn A69 Richtung Lötschberg. Nehmen Sie die Ausfahrt Gagglisberg und fahren Sie ins Dorf.</p>
    </div>
  </body>
</html>