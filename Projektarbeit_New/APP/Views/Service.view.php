<?php
function drawServiceView() {
?>
    <div class="transbox">

      <p class="pcenter">Service in Auftrag geben</p>
      <p class="pcenter">

      <form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
        <div class="form-group">
          <label for="Priorität">Priorität</label><br>
          <input type="text" class="form-control" name="Priorität" id="Priorität" placeholder=" " required>
        </div>
        <div class="form-group">
          <label for="Servicetyp">Priorität</label><br>
          <input type="Priorität" class="form-control" name="Priorität" id="Priorität" placeholder="Passwort" required>
        </div>

    </div>
<?php
}
?>