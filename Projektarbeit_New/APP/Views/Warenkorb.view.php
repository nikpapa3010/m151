<?php
function drawWarenkorbView() {
?>
    <div class="transbox">

      <p class="pcenter">Warenkorb</p>
      <p class="pcenter">

      <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">

        <table class="table">
          <thead>
              <tr>
                  <th scope= "col">Benutzername</th>
                  <th scope= "col">Service/Mietauftrag</th>
                  <th scope= "col">Priorität</th>
              </tr>
          </thead>
          <tbody>
          </tbody>    
        </table>

        <button style="float: center-left;"type="reset" name="submit" class="btn btn-danger ">Alles Löschen</button>
        <button style="float: right;" type="submit" name="submit" class="btn btn-primary">  Kaufen/Senden</button>
      </form>
    </div>
<?php
}
?>