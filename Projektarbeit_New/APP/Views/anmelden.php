<html>
    <body>
    <?php include './header.view.php' ?>

        <div class="container">
          <div class="transbox">
             <h1>Registrierung</h1>
             

    
              <br>
              <br>
                
      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
      <div class="form-group">
          <label for="username">Benutzername / Email</label><br>
          <input type="text" class="form-control" name="username" id="username" placeholder="Benutzername / Email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label><br>
          <input type="password" class="form-control" name="password" id="password" placeholder="Passwort" required>
        </div>
        <div class="text-right">
          <button type="submit" id="login" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
<br>
    <?php include './footer.view.php' ?>
    </body>
</html>