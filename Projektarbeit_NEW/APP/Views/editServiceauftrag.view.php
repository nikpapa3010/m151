<?php
function drawEditServiceauftragView(array $serviceobjekte, array $prioritaeten, array $stati, Serviceauftrag $sa) {
  ?>
    <div class="transbox">
      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group">
          <label for="Servicetyp">Servicetyp</label>
          <select class="form-control" name="Servicetyp" id="Servicetyp">
            <?php foreach ($serviceobjekte as $so) { ?>
            <option value="<?php echo $so->ServiceobjektID; ?>"<?php if
              ($so->ServiceobjektID == $sa->ServiceobjektFK) { echo ' selected'; }
              ?>><?php echo $so->Bezeichnung . " (CHF " . $so->Grundpreis . ")"; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="prio">Priorität</label>
          <select class="form-control" name="prio" id="prio">
            <?php foreach ($prioritaeten as $prio) { ?>
            <option value="<?php echo $prio->PrioID; ?>"<?php if ($prio->PrioID == $sa->PrioFK)
              { echo ' selected'; } ?>><?php echo $prio->Bezeichnung .
              " (" . $prio->Dauer . " Tage, zusätzlich CHF " . $prio->Aufschlag . ")"; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class ="form-group">
          <label for="status" class="col-form-label">Status</label><br />
          <select class="form-control" name="status" id="status"<?php
            if ($_SESSION['berechtigung'] == 0) { echo ' disabled'; } ?>>
            <?php foreach($stati as $status) { ?>
              <option value="<?php echo $status->StatusID; ?>"<?php if (
                $sa->StatusFK == $status->StatusID) { echo ' selected'; } ?>><?php echo
                $status->Bezeichnung; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="editsubmit"
            value="<?php echo $sa->ServiceauftragID; ?>">Änderungen speichern!</button>
        </div>
      </form>
    </div>
  <?php
}
?>