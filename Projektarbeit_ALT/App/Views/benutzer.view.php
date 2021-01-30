<?php require "../Controllers/benutzer.logik.php" ?>
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
    
    <title>Benutzer | Jetstream-Service</title>
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
            <?php if (isset($_SESSION["username"])) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo htmlspecialchars($_SESSION["username"]) ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./dashboard.view.php">Dashboard</a>
                  <a class="dropdown-item active" href="./benutzer.view.php">Benutzer <span class="sr-only">(current)</span></a>
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

      <h1>Benutzer</h1>

      <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">
        <button type="submit" name="submit" class="btn btn-primary">Änderungen speichern!</button>

        <table class="table">
          <thead>
            <tr>
              <th scope= "col">Benutzername</th>
              <th scope= "col">Name</th>
              <th scope= "col">Email</th>
              <th scope= "col">Telefonnummer</th>   
              <th scope= "col">Rang</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $stmt = $pdo->prepare("select * from allebenutzer");
              $stmt->execute([]);
              
              while($row = $stmt->fetch()) 
              {
                echo "<tr><td>" . $row["Benutzername"] . "</td>" .
                     "<td>" . $row["Name"] . "</td>" .
                     "<td>" . $row["Email"] . "</td>" .
                     "<td>" . $row["Telefonnummer"] . "</td>"; ?>
                <td><select name=<?php echo htmlspecialchars($row["UserID"]) ?>>
                  <?php
                  $status = $pdo->query("select * from rang");
                  
                  while ($s = $status->fetch()) { ?>
                    <option value=<?php echo htmlspecialchars($s["RangID"]);
                    if ($s["Rang"] == $row["Rang"]) { echo " selected"; } ?>>
                    <?php echo htmlspecialchars($s["Rang"]) ?></option>
                  <?php } ?>
                </select></td>
                  
              <?php }
            ?>
                  
          </tbody>    
        </table>

        <button type="submit" name="submit" class="btn btn-primary">Änderungen speichern!</button>
      </form>
    </div>
 </body>
</html>