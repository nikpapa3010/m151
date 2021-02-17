
<?php function drawProfileOptionsView(Benutzer $user, array $raenge, bool $canPromote, bool $abgesendet, array $errors) { ?>
    <div class="transbox">
      <h1>Profiloptionen</h1>

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
          <li>Änderungen erfolgreich!</li>
          </ul>
        <?php }
      } ?>

      <form action='<?php echo $_SERVER["PHP_SELF"]; if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect']; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label for="Vorname">Vorname</label>
            <input type="Vorname" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname"
              <?php echo 'value="'.$user->Vorname.'"'; ?> required>   
          </div>
          <div class="col-md">
            <label for="Nachname">Nachname</label>
            <input type="Nachname" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname"
              <?php echo 'value="'.$user->Nachname.'"'; ?> required>   
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
              <?php echo 'value="'.$user->Email.'"'; ?> required>
          </div>
          <div class="col-md">
            <label for="tel">Telefon (Optional)</label>
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="012 345 67 89"
              pattern="0[0-9]{2}[-/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}"
              <?php echo 'value="'.$user->Telefon.'"'; ?>>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="rang">Rang</label>
            <select name="rang" id="rang" class="form-control" <?php if (!$canPromote) { echo 'disabled '; } ?>>
              <?php foreach ($raenge as $rang) { ?>
                <option value="<?php echo $rang->RangID; ?>" <?php if ($user->RangFK == $rang->RangID) { echo 'selected '; } ?>><?php echo $rang->Bezeichnung; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12">
            <label for="pwalt">Altes Passwort</label>
            <input type="password" class="form-control" id="pwalt" name="pwalt" placeholder="Altes Passwort">
          </div>
          <div class="col-md-6">
            <label for="Passwort">Neues Passwort</label>
            <input type="password" class="form-control" id="Passwort" name="Passwort" placeholder="Neues Passwort">
          </div>
          <div class="col-md-6">
            <label for="PasswortWiederh">Neues Passwort wiederholen</label>
            <input type="password" class="form-control" id="PasswortWiederh" name="PasswortWiederh" placeholder="Neues Passwort wiederholen">
          </div>
        </div>
        <div class="row">
          <div class="col-sm mb-2 mb-sm-0">
            <button type="submit" class="btn btn-danger" name="delete">Konto löschen</button>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" class="btn btn-primary" name="submit">Änderungen speichern!</button>
          </div>
        </div>
      </form>
    </div>
<?php } ?>