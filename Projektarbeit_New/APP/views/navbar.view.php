<?php
function drawNavbar(bool $loggedin = false, string $username = null) {
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Alpine_skiing_pictogram.svg/1200px-Alpine_skiing_pictogram.svg.png" width="50" height="50" class="d-inline-block align-top" alt="" >

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href=".">Startseite</a>
          </li>
          
         
          <?php if($loggedin){ ?>
        <li class="nav-item dropdown ">
         <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Anmelden
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./service.php">Service</a>
          <a class="dropdown-item" href="./mietformular.php">Miete</a>
          </div>
          <?php }?>
          <li class="nav-item active">
            <a class="nav-link" href="./kontakt.php">Kontakt</a>
          </li>
        </ul>   
        <ul class="navbar-nav ml-auto">
          <?php if($loggedin){ ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" color="#fff" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo htmlspecialchars($_SESSION['name']) ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="./warenkorb.php">Warenkorb</a>
              <a class="dropdown-item" href="./auftragsliste.php">Bestellungen</a>
              <a class="dropdown-item" href=".">Einstellungen</a>
              <a class="dropdown-item" href="./logout.php">Logout</a>
            </div>
          </li>
          <?php }else{ ?>
          <li class="nav-item active">
            <a class="nav-link" href="./login.php">Anmelden</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="./registrieren.php">Registrieren</a>
          </li>
          <?php } ?>

        </ul>
      </div>
    </nav>
<?php
}
?>