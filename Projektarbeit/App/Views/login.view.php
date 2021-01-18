
    <?php require "../Controllers/login.logik.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Login</title>
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
            <li class="nav-item active">
              <a class="nav-link" href="./login.view.php">Einloggen <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./register.view.php">Registrieren</a>
            </li>
          </ul>
        </div>
      </nav>
      
      <h1>Login</h1>
      <?php if (!empty($errors)) { ?>
        <ul class="alert alert-danger">
          <?php foreach ($errors as $e) {
            echo "<li>" . htmlspecialchars($e) . "</li>";
          } ?>
        </ul>
      <?php } ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="username">Benutzername / Email</label><br>
          <input type="text" class="form-control" name="username" id="username" placeholder="Benutzername / Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" class="form-control" name="password" id="password" placeholder="Passwort" required>
        </div>
        <div class="text-right">
          <button type="submit" id="login" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
