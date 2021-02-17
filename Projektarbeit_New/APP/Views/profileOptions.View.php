
<?php function drawProfileOptionsView() { ?>
    <div class="transbox">
      <h1>Profiloptionen</h1>

      <form action='<?php echo $_SERVER["PHP_SELF"]; if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect']; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label for="Vorname">Vorname</label>
            <input type="Vorname" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname"
              <?php if (isset($_POST['submit'])) echo 'value="'.$_POST['Vorname'].'"'; ?> required>   
          </div>
          <div class="col-md">
            <label for="Nachname">Nachname</label>
            <input type="Nachname" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname"
              <?php if (isset($_POST['submit'])) echo 'value="'.$_POST['Nachname'].'"'; ?> required>   
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
              <?php if (isset($_POST['submit'])) echo 'value="'.$_POST['email'].'"'; ?> required>
          </div>
          <div class="col-md">
            <label for="tel">Telefon (Optional)</label>
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="012 345 67 89"
              pattern="0[0-9]{2}[-/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}"
              <?php if (isset($_POST['submit'])) echo 'value="'.$_POST['tel'].'"'; ?>>
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
        <div class="row">
          <div class="col-sm mb-2 mb-sm-0">
            <a href="login.php<?php if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect']; ?>">
              <button type="button" class="btn btn-outline-primary">Ich habe schon ein Konto</button>
            </a>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" class="btn btn-primary" name="submit">Registrieren!</button>
          </div>
        </div>
      </form>
    </div>
<?php } ?>