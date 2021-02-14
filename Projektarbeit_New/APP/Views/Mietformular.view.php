<?php
function drawMietformularView(bool $abgesendet, array $errors, array $objtypen) {
?>
    <div class="transbox">
      <h1>Schneeportgeräte mieten</h1>

      <?php
      if ($abgesendet) {
        if (count($errors) > 0) { ?>
          <ul class='alert alert-danger'>
          <?php foreach ($errors as $e) {
            echo "<li>$e</li>";
          } ?>
          </ul>
        <?php } else { ?>
          <ul class='alert alert-success'>
            <li>Reservierung erfolgreich!</li>
          </ul>
        <?php }
      } ?>

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class ="form-group">
          <label for="objtyp" class="col-form-label">Objekttyp</label><br />
          <select class="form-control" name="objtyp" id="objtyp">
            <?php foreach ($objtypen as $objtyp) { ?>
              <option value=<?php echo '"' . $objtyp->ObjekttypID . '"';
              if (isset($_POST['objtyp']) && $_POST['objtyp'] == $objtyp->ObjekttypID) echo ' selected';
              ?>><?php echo $objtyp->Bezeichnung; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="groesse" class="col-form-label">Körpergrösse (in cm)</label><br />
          <input type="number" class="form-control" name="groesse" id="groesse" min="80" max="300"
            <?php if (isset($_POST['groesse'])) echo 'value="'.$_POST['groesse'].'"'; else echo 'value="170"'; ?> required />
        </div>

        <div class ="form-group">
          <label for="gesch" class="col-form-label">Geschlecht</label><br />
          <select class="form-control" name="gesch" id="gesch">
            <option value="w" <?php if (!isset($_POST['gesch']) || $_POST['gesch'] == 'w') echo 'selected '; ?>>weiblich</option>
            <option value="m" <?php if (isset($_POST['gesch']) && $_POST['gesch'] == 'm') echo 'selected '; ?>>männlich</option>
            <option value="d" <?php if (isset($_POST['gesch']) && $_POST['gesch'] == 'd') echo 'selected '; ?>>divers</option>
            <option value="u" <?php if (isset($_POST['gesch']) && $_POST['gesch'] == 'u') echo 'selected '; ?>>ugly</option>
          </select>
        </div>

        <div class="form-group">
          <label for="alter" class="col-form-label">Altersgruppe</label><br />
          <select class="form-control" name="alter" id="alter">
            <option value="Kind" <?php if (isset($_POST['alter']) && $_POST['alter'] == 'Kind') echo 'selected '; ?>>Kind (unter 12 Jahren)</option>
            <option value="Jugendlich" <?php if (isset($_POST['alter']) && $_POST['alter'] == 'Jugendlich') echo 'selected '; ?>>Jugendlich (12-25 Jahre)</option>
            <option value="Erwachsen" <?php if (!isset($_POST['alter']) || $_POST['alter'] == 'Erwachsen') echo 'selected '; ?>>Erwachsen (über 25 Jahren)</option>
            <option value="doof" <?php if (isset($_POST['alter']) && $_POST['alter'] == 'doof') echo 'selected '; ?>>doof</option>
          </select>
        </div>
      
        <div class="form-group row">
          <div class="col-md">
            <label for="start" class="col-form-label">Startdatum</label><br />
            <input type="date" class="form-control" name="start" id="start" min="<?php echo date('Y-m-d'); ?>"
              <?php if (isset($_POST['start'])) echo 'value="'.$_POST['start'].'"'; ?> required />
          </div>
          <div class="col-md">
            <label for="ende" class="col-form-label">Enddatum</label><br />
            <input type="date" class="form-control" name="ende" id="ende" min="<?php echo date('Y-m-d'); ?>"
              <?php if (isset($_POST['ende'])) echo 'value="'.$_POST['ende'].'"'; ?> required />
          </div>
        </div>
        
        <div class="text-right">
          <button type="submit" class="btn btn-primary" name="submit">Reservieren!</button>
        </div>

    </div>
<?php
}
?>