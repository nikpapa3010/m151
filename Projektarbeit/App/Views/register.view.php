<?php require "../Controllers/register.logik.php" ?>
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
 

    <title>Registrierung | Jetstream-Service</title>

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

      <h1>Registrierung</h1>

      <?php
      if (isset($_POST["submit"])) {
        if (!empty($errors)) {
          echo "<ul class='alert alert-danger'>\n";
          foreach ($errors as $e) {
            echo "<li>" . $e . "</li>\n";
          }
          echo "</ul>";
        } else { ?>
          <ul class='alert alert-success'>\n
          <li>Registrierung erfolgreich!</li>\n
          <li>Sie werden in Kürze zur Startseite weitergeleitet.</li>\n
          <meta http-equiv="Refresh" content="3; url='..'" />
          </ul>
        <?php }
      }
      ?>
    
      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label for="username">Benutzername</label>
            <input type="username" class="form-control" id="username" name="username" placeholder="Benutzername"
              <?php if (isset($_POST["submit"])) echo "value=$un"; ?>>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="vorname">Vorname</label>
            <input type="text" class="form-control" id="vorname" name="vorname" placeholder="Vorname"
              <?php if (isset($_POST["submit"])) echo "value=$vn"; ?>>
          </div>
          <div class="col-md">
            <label for="nachname">Nachname</label>
            <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname"
              <?php if (isset($_POST["submit"])) echo "value=$nn"; ?>>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="beispiel@example.com"
              <?php if (isset($_POST["submit"])) echo "value=$em"; ?>>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="tel">Telefon</label>
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="012 345 67 89" pattern="0[0-9]{2}[-/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}"
              <?php if (isset($_POST["submit"])) echo "value=$tl"; ?>>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="Passwort">Passwort</label>
            <input type="password" class="form-control" id="Passwort" name="Passwort" placeholder="Passwort">
          </div>
          <div class="col-md">
            <label for="PasswortWiederh">Passwort wiederholen</label>
            <input type="password" class="form-control" id="PasswortWiederh" name="PasswortWiederh" placeholder="Passwort wiederholen">
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="submit">Registrieren!</button>
        </div>
      </form>
    </div>
  </body>
</html>