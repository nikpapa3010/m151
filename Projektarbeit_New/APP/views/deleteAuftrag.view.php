<?php
function drawDeleteAuftragView(bool $warenkorb, int $index) {
  ?>
    <div class="transbox">

      <h1>Auftrag löschen</h1>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label>Wollen Sie diesen Auftrag wirklich löschen?</label>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm mb-2 mb-sm-0">
            <a href="<?php echo $warenkorb ? 'warenkorb.php' : 'auftragsliste.php' ?>"><button type="button" class="btn btn-success">Löschen abbrechen</button></a>
          </div>
          <div class="col-sm text-sm-right">
            <button type="submit" name="deleteconfirm" class="btn btn-danger" value="<?php echo $index; ?>">Ja, löschen</button>
          </div>
        </div>
      </form>
    </div>
  <?php
}
?>