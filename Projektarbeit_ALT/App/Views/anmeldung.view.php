<?php require "../Controllers/anmeldung.logik.php"?>
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
            <li class="nav-item active">
              <a class="nav-link" href="./anmeldung.view.php">Anmeldung <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./kontakt.view.php">Kontakt</a>
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
      <h1>Anmeldung</h1>
      <p></p>

      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class ="form-group">
          <label for="pr" class="col-sm2 col-form-label">Priorität</label><br>
          <select class="form-control" name="pr" >
            <?php
              $sqlprio = "select * from Prioritaet;";
              
              $prio = $pdo->query($sqlprio);
              $prio->setFetchMode(PDO::FETCH_ASSOC);

              while ($r = $prio->fetch()): ?>
                <option value ="<?php echo htmlspecialchars($r['PrioID']) ?>">
                  <?php echo htmlspecialchars($r['Prioritaet']) ?>
                  (<?php echo htmlspecialchars($r['totalTage']) ?> Tage, zusätzlich CHF
                  <?php echo htmlspecialchars($r['Aufschlag']) ?>)
                </option>
            <?php endwhile; ?>
          </select>
        </div>
          
        <div class ="form-group">
          <label for="di" class="col-sm2 col-form-label">Dienstleistung</label><br>
          <select class="form-control" name="di" >
            <?php
              $sqldienst = "select * from Dienstleistung;";
              
              $dienst = $pdo->query($sqldienst);
              $dienst->setFetchMode(PDO::FETCH_ASSOC);
              while ($r = $dienst->fetch()): ?>
                <option value ="<?php echo htmlspecialchars($r['DienstID']) ?>">
                  <?php echo htmlspecialchars($r['Dienstleistung']) ?>
                  (CHF <?php echo htmlspecialchars($r['Preis']) ?>)
                </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="text-right">
          <p>
            Totaler Preis: CHF xx.xx <br>
            Abholdatum: dd.mm.yyyy
          </p>
          <button type="submit" name="submit" class="btn btn-primary">Sumbit</button>
        </div>
      </form>

    </div>
  </body>
</html> 