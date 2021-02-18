<?php
function drawWarenkorbLeerenView() {
  ?>
    <div class="transbox">

      <h1>Warenkorb leeren</h1>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label>Wollen Sie den Warenkorb wirklich leeren?</label>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm mb-2 mb-sm-0">
            <a href="warenkorb.php"><button type="button" class="btn btn-success">Leeren abbrechen</button></a>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" name="confirm" class="btn btn-danger">Ja, leeren</button>
          </div>
        </div>
      </form>
    </div>
  <?php
}
?>