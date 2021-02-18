<?php
function draweditServiceauftragView(bool $warenkorb,  array $serviceobjekte, array $prioritaeten) {
  ?>
      <div class="transbox">
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
    <button type="submit" class="btn btn-primary" name="submit">Bearbeitung Speichern!</button>
  </div>
</form>
</div>
  <?php
}
?>