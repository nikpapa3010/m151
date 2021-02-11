<?php
function drawRegistrierenView(bool $abgesendet, array $errors, string $vn, string $nn, string $em, $tl) {
?>
    <div class="transbox">
      <h1>Registrierung</h1>

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
          <li>Registrierung erfolgreich!</li>
          <li>Sie werden in Kürze zur Startseite weitergeleitet.</li>
          <meta http-equiv="Refresh" content="3; url='.'" />
          </ul>
        <?php }
      } ?>
                    
      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md-6">
            <label for="Vorname">Vorname</label>
            <input type="Vorname" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname" value="<?php echo $vn; ?>">   
          </div>
          <div class="col-md-6">
            <label for="Nachname">Nachname</label>
            <input type="Nachname" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname" value="<?php echo $nn; ?>">   
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?php echo $em; ?>">
          </div>
          <div class="col-md">
            <label for="tel">Telefon (Optional)</label>
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="012 345 67 89" pattern="0[0-9]{2}[-/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}" value="<?php echo $tl; ?>">
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
<?php
}
?>