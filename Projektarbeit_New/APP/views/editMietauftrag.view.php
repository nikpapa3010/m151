<?php
function drawEditMietauftragView(array $stati, Mietauftrag $ma) {
  ?>
  <div class="transbox">
      <h1>Mietauftrag bearbeiten</h1>
     
      <p>Falls sie ein anderes Produkt benötigen, bitten wir Sie, <a href="mietformular.php">hier
        einen neuen Auftrag zu erstellen</a> und den alten zu löschen.</p>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group row">
          <div class="col-md">
            <label for="start" class="col-form-label">Startdatum</label><br />
            <input type="date" class="form-control" name="start" id="start" min="<?php echo date('Y-m-d'); ?>"
              value="<?php echo $ma->Startdatum; ?>" required />
          </div>
          <div class="col-md">
            <label for="ende" class="col-form-label">Enddatum</label><br />
            <input type="date" class="form-control" name="ende" id="ende" min="<?php echo date('Y-m-d'); ?>"
              value="<?php echo date_format(date_add(date_create($ma->Startdatum),
              date_interval_create_from_date_string($ma->Dauer . ' days')), 'Y-m-d'); ?>" required />
          </div>
        </div>

        <div class="form-group">
          <label for="menge" class="col-form-label">Menge</label><br />
          <input type="number" class="form-control" name="menge" id="menge" min="1" max="10"
            value="<?php echo $ma->Menge; ?>" required />
        </div>

        <div class ="form-group">
          <label for="status" class="col-form-label">Status</label><br />
          <select class="form-control" name="status" id="status"<?php
            if ($_SESSION['berechtigung'] == 0) { echo ' disabled'; } ?>>
            <?php foreach($stati as $status) { ?>
              <option value="<?php echo $status->StatusID; ?>"<?php if (
                $ma->StatusFK == $status->StatusID) { echo ' selected'; } ?>><?php echo
                $status->Bezeichnung; ?></option>
            <?php } ?>
          </select>
        </div>
        
        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="editsubmit"
            value="<?php echo $ma->MietauftragID; ?>">Änderungen speichern!</button>
        </div>
      </form>
    </div>
  <?php
}
?>