<?php
function drawBenutzerlisteView(array $users) {
?>
    <div class="transbox">

      <h1>Benutzerliste</h1>

      <form action='profileOptions.php' method="POST">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th class="d-table-cell">Name</th>
              <th class="d-table-cell">Email</th>
              <th class="d-table-cell">Telefon</th>
              <th class="d-table-cell">Rang</th>
              <th class="d-table-cell"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) {?>
              <tr>
                <td class="d-table-cell"><?php echo $user->Name; ?></td>
                <td class="d-table-cell"><?php echo $user->Email; ?></td>
                <td class="d-table-cell"><?php echo $user->Telefon; ?></td>
                <td class="d-table-cell"><?php echo $user->Rang; ?></td>
                <td class="d-table-cell">
                  <button type="submit" name="edit" value="<?php echo $user->BenutzerID; ?>" class="btn btn-primary">&#x270F;</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
    </div>
<?php
}
?>