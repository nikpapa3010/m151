
    <?php require "../Controllers/dashboard.logik.php" ?>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <title>Dashboard | Jetstream-Service</title>
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
              <a class="nav-link" href="./anmeldung.view.php">Anmeldung</span></a>
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
                  <a class="dropdown-item active" href="./dashboard.view.php">Dashboard <span class="sr-only">(current)</a>
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

      <h1>Dashboard</h1>

      <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">
        <button type="submit" name="submit" class="btn btn-primary">Änderungen speichern!</button>

        <table class="table">
          <thead>
              <tr>
                  <th scope= "col">Benutzername</th>
                  <th scope= "col">Dienstleistung</th>
                  <th scope= "col">Priorität</th>
                  <th scope= "col">Status</th>   
                  <th scope= "col">StartDatum</th>
                  <th scope= "col">EndDatum</th>
                  <th scope= "col">Preis</th>
              </tr>
          </thead>
          <tbody>
            <?php
              if ($showAll) {
                $stmt = $pdo->prepare("select * from offeneauftraege");
                $stmt->execute();
              } else {
                $stmt = $pdo->prepare("select * from offeneauftraege where benutzername = :un");
                  $stmt->execute([":un" => $username]);
                }
              
              while($row = $stmt->fetch()) 
              {
                  echo "<tr><td>" . $row["Benutzername"] . "</td>" .
                      "<td>" . $row["Dienstleistung"] . "</td>" .
                      "<td>" .  $row["Priorität"] . "</td>";
                  if ($showAll) { ?>
                    <td><select name=<?php echo htmlspecialchars($row["AuftragID"]) ?>>
                    <?php
                    $status = $pdo->query("select * from status");
                    
                    while ($s = $status->fetch()) { ?>
                      <option value=<?php echo htmlspecialchars($s["StatusID"]);
                      if ($s["Status"] == $row["Status"]) { echo " selected"; } ?>>
                      <?php echo htmlspecialchars($s["Status"]) ?></option>
                    <?php } ?>
                    </select></td>
                  <?php } else { 
                    echo "<td>" . $row["Status"] . "</td>";
                  }
                  echo "<td>" . $row["StartDatum"] . "</td>" .
                      "<td>" . $row["EndDatum"] . "</td>" .
                      "<td>" . $row["Preis"] . "</td></tr>";
              }
            ?>
                  
          </tbody>    
        </table>

      <button type="submit" name="submit" class="btn btn-primary">Änderungen speichern!</button>
      </form>
    </div>
 </body>
</html>
