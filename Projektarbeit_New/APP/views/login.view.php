<?php
function drawLoginView(bool $abgesendet, array $errors) {
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
          <li>Sie werden in Kürze zur Startseite weitergeleitet.</li>
          <meta http-equiv="Refresh" content="3; url='.'" />
          </ul>
        <?php }
      } ?>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group">
          <label for="username">Email</label><br>
          <input type="text" class="form-control" name="username" id="username" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" class="form-control" name="password" id="password" placeholder="Passwort" required>
        </div>
        <div class="text-right">
          <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
<?php
}
?>