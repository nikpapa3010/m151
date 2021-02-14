<?php
function drawLoginView(bool $abgesendet, array $errors, string $redirect = '.') {
?>
    <div class="transbox">
      <h1>Anmeldung</h1>
      
      <?php
      if ($abgesendet) {
        if (count($errors) > 0) { ?>
          <ul class='alert alert-danger'>
          <?php foreach ($errors as $e) {
            echo "<li>$e</li>";
          } ?>
          </ul>
        <?php } else { ?>
          <ul class='alert alert-success'>
          <li>Anmeldung erfolgreich!</li>
          <li>Sie werden in Kürze weitergeleitet.</li>
          <meta http-equiv="Refresh" content="3; url='<?php echo $redirect; ?>'" />
          </ul>
        <?php }
      } ?>

      <form action='<?php echo $_SERVER["PHP_SELF"]; if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect']; ?>' method="POST">
        <div class="form-group">
          <label for="username">Email</label><br>
          <input type="text" class="form-control" name="username" id="username" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" class="form-control" name="password" id="password" placeholder="Passwort" required>
        </div>
        <div class="row">
          <div class="col-sm mb-2 mb-sm-0">
            <a href="registrieren.php<?php if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect'] ?>">
              <button type="button" class="btn btn-outline-primary">Ich habe noch kein Konto</button>
            </a>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </form>
    </div>
<?php
}
?>