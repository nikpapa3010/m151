<?php
function drawMietformularView() {
?>
    <div class="transbox">

      <p class="pcenter">Schneeportgeräte mieten</p>
      <p class="pcenter">

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group">
          <label for="Körpergrösse">Körpergrösse (in cm)</label><br>
          <input type="number" class="form-control" name="Körpergrösse" id="Körpergrösse" placeholder="180" min="130"  required>
        </div>

        <div class ="form-group">
          <label for="Geschlecht" class="col-sm2 col-form-label">Geschlecht</label><br>
          <select class="form-control" name="Geschlecht" >
          <option value="Test"></option>
          </select>
        </div>

        <div class ="form-group">
          <label for="Altergruppe" class="col-sm2 col-form-label">Altergruppe</label><br>
          <select class="form-control" name="Altergruppe" >
          <option value="Test"></option>
          </select>
        </div>
      
        <div class="form-group">
          <label for="Startdatum">Startdatum</label><br>
          <input type="date" class="form-control" name="Startdatum" id="Startdatum" placeholder="Startdatum" required>
          <label for="Enddatum">Enddatum</label><br>
          <input type="date" class="form-control" name="Enddatum" id="Enddatum" placeholder="Enddatum" required>
        </div>

    </div>
<?php
}
?>