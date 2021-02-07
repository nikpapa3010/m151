<html>
    <body>
    <?php include './header.view.php' ?>

        <div class="container">
          <div class="transbox">
             <h1>Registrierung</h1>
             

    
              <br>
              <br>
                
      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
             <div class="form-group row">
              <div class="col-md-6">
                <label for="Vorname">Vorname</label>
                <input type="Vorname" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname">   
              </div>
              <div class="col-md-6">
                <label for="Nachname"> Nachname</label>
                <input type="Nachname" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname">   
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail">
              </div>
              <div class="col-md">
                <label for="tel">Telofon (Optional)</label>
                <input type="tel" class="form-control" id="tel" name="tel" placeholder="012 345 67 89" pattern="0[0-9]{2}[-/ ]*[0-9]{3}[- ]*[0-9]{2}[- ]*[0-9]{2}">
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
<br>
    <?php include './footer.view.php' ?>
    </body>
</html>