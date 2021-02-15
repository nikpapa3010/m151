<?php
function drawServiceView(array $prioritaeten, array $serviceobjekte) {
?>
    <div class="transbox">

      <h1>Service in Auftrag geben</h1>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group">
          <label for="Servicetyp">Servicetyp</label>
          <select class="form-control" name="Servicetyp" id="Servicetyp">
            <?php foreach ($serviceobjekte as $serviceobjekt) { ?>
            <option value="<?php echo $serviceobjekt->ServiceobjektID; ?>"><?php echo $serviceobjekt->Bezeichnung .
              " (CHF " . $serviceobjekt->Grundpreis . ")"; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="prio">Priorität</label>
          <select class="form-control" name="prio" id="prio">
            <?php foreach ($prioritaeten as $prioritaet) { ?>
            <option value="<?php echo $prioritaet->PrioID; ?>"><?php echo $prioritaet->Bezeichnung .
              " (" . $prioritaet->Dauer . " Tage, zusätzlich CHF " . $prioritaet->Aufschlag . ")"; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="submit">in Auftrag geben!</button>
        </div>
      </form>
    </div>
<?php
}
?>