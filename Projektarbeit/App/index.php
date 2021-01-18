<?php
  session_start();
  if (isset($_SESSION["username"])) {
    $un = $_SESSION["username"];
    
    require_once './Core/database.inc.php';
    function accessUsers($username) : bool {
      $pdo = connect();
      $stmt = $pdo->prepare("select ShowAll from benutzer inner join Rang on Benutzer.RangID = Rang.RangID where benutzername = :un;");
      $stmt->execute([':un' => $username]);
    
      $fetched = $stmt->fetch();
      $showAll = $fetched["ShowAll"];
      return $showAll;
    }
    $accessUsers = accessUsers($un);
  }
?>
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
            <li class="nav-item active">
              <a class="nav-link" href=".">Startseite <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Views/anmeldung.view.php">Anmeldung</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Views/kontakt.view.php">Kontakt</a>
            </li>
          </ul>
          <ul class="navbar-nav mr-0 my-lg-0">
            <?php if (isset($_SESSION["username"])) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo htmlspecialchars($_SESSION["username"]) ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./Views/dashboard.view.php">Dashboard</a>
                  <?php if ($accessUsers) { echo '<a class="dropdown-item" href="./benutzer.view.php">Benutzer</a>'; } ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="./Views/logout.view.php">Ausloggen</a>
                </div>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link" href="./Views/login.view.php">Einloggen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./Views/register.view.php">Registrieren</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </nav>
      <h1>Willkommen!</h1>
      <p>Der Ski-Service Ihrer Träume!<br>
      Pünktlich, günstig und gut!</p>
      <img src="https://www.myskirent.com//app/uploads/2016/10/Skiservice_Palace_001-670x289.jpg" style="width: 100%;">
      <h2>Unser Angebot</h2>
      <ul>
        <li>Kleiner Service</li>
        <li>Grosser Service</li>
        <li>Rennski-Service</li>
        <li>Bindung montieren und einstellen</li>
        <li>Fell zuschneiden</li>
        <li>Heisswachsen</li>
      </ul>
      <p>Ihre Skier sind bei uns standardmässig 7 Tage im Service. Gegen einen Aufpreis sind wir schon in 5 Tagen fertig.</p>
    </div>
  </body>
</html>