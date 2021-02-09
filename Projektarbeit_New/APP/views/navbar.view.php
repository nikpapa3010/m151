<?php
function drawNavbar(bool $loggedin = false) {
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
          <li class="nav-item active">
            <a class="nav-link" href="./kontakt.php">Kontakt</a>
          </li>
        </ul>   
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./login.php">Anmelden</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="./registieren.php">Registieren</a>
          </li>
        </ul>
      </div>
    </nav>
<?php
}
?>