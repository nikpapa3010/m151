<?php
function drawAbschliessenView(){
  ?>
    <div class="transbox">
      <h1>Bestellung abschliessen</h1>

      <form  action='<?php echo $_SERVER["PHP_SELF"]; if (isset($_GET['redirect'])) echo '?redirect=' . $_GET['redirect']; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label>Wollen Sie wirklich die Bestellung abschliessen?</label>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm mb-2 mb-sm-0">
            <a href="warenkorb.php"><button type="button" class="btn btn-danger">Nein, zurück</button></a>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" name="submit" class="btn btn-success">Ja, abschliessen!</button>
          </div>
        </div>
      </form>
    </div>
  <?php
}
?>