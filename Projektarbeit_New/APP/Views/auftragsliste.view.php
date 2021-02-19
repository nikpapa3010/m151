<?php
function drawAuftragslisteView(bool $showUser, array $mietauftraege, array $serviceauftraege, bool $warenkorb) {
?>
    <div class="transbox">

      <h1><?php echo $warenkorb ? "Warenkorb" : "Auftragsliste" ?></h1>

      <h2>Mietaufträge</h2>
      <form action="editMietauftrag.php" method="POST">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <?php if ($showUser) { ?><th class="d-table-cell">Benutzer</th><?php } ?>
              <th class="d-table-cell">Mietobjekt</th>
              <th class="d-none d-lg-table-cell">Reservation</th>
              <th class="d-none d-md-table-cell">Startdatum</th>
              <th class="d-none d-sm-table-cell">Enddatum</th>
              <th class="d-<?php if ($showUser) { ?>none d-sm-<?php } ?>table-cell">Preis</th>
              <th class="d-none d-lg-table-cell">Status</th>
              <th class="d-table-cell"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mietauftraege as $mietauftrag) {?>
              <tr>
                <?php if ($showUser) { ?><td class="d-table-cell"><?php echo $mietauftrag->Name; ?></th><?php } ?>
                <td class="d-table-cell"><?php echo $mietauftrag->Miete; ?></td>
                <td class="d-none d-lg-table-cell"><?php echo $mietauftrag->Reservationsdatum; ?></td>
                <td class="d-none d-md-table-cell"><?php echo $mietauftrag->Startdatum; ?></td>
                <td class="d-none d-sm-table-cell"><?php echo $mietauftrag->EndDatum; ?></td>
                <td class="d-<?php if ($showUser) { ?>none d-sm-<?php } ?>table-cell"><?php echo $mietauftrag->Preis; ?></td>
                <td class="d-none d-lg-table-cell"><?php echo $mietauftrag->Status; ?></td>
                <td class="d-table-cell">
                  <?php if ($mietauftrag->bearbeitbar) { ?>
                  <button type="submit" name="edit" class="btn btn-primary" value="<?php echo $mietauftrag->MAID; ?>">&#x270F;</button>
                  <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $mietauftrag->MAID; ?>">&#x232B;</button>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>    
        </table>
      </form>

      <h2>Serviceaufträge</h2>
      <form action="editServiceauftrag.php" method="POST">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <?php if ($showUser) { ?><th class="d-table-cell">Benutzer</th><?php } ?>
              <th class="d-table-cell">Serviceobjekt</th>
              <th class="d-none d-lg-table-cell">Startdatum</th>
              <th class="d-none d-md-table-cell">Enddatum</th>
              <th class="d-none d-lg-table-cell">Priorität</th>
              <th class="d-<?php if ($showUser) { ?>none d-sm-<?php } ?>table-cell">Preis</th>
              <th class="d-none d-lg-table-cell">Status</th>
              <th class="d-table-cell"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($serviceauftraege as $serviceauftrag) {?>
              <tr>
                <?php if ($showUser) { ?><td class="d-table-cell"><?php echo $serviceauftrag->Name ?></td><?php } ?>
                <td class="d-table-cell"><?php echo $serviceauftrag->Service ?></td>
                <td class="d-none d-lg-table-cell"><?php echo $serviceauftrag->Startdatum ?></td>
                <td class="d-none d-md-table-cell"><?php echo $serviceauftrag->EndDatum ?></td>
                <td class="d-none d-lg-table-cell"><?php echo $serviceauftrag->Prioritaet ?></td>
                <td class="d-<?php if ($showUser) { ?>none d-sm-<?php } ?>table-cell"><?php echo $serviceauftrag->Preis ?></td>
                <td class="d-none d-lg-table-cell"><?php echo $serviceauftrag->Status ?></td>
                <td class="d-table-cell">
                  <?php if ($serviceauftrag->bearbeitbar) { ?>
                  <button type="submit" name="edit" class="btn btn-primary" value="<?php echo $serviceauftrag->SAID; ?>">&#x270F;</button>
                  <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $serviceauftrag->SAID; ?>">&#x232B;</button>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>    
        </table>
      </form>
      <?php if ($warenkorb) { ?>
        <div class="row">
          <div class="col-sm mb-2 mb-sm-0"><a href="">
            <button class="btn btn-danger">Alles Löschen!</button>
          </a></div>
          <div class="col-sm text-sm-right"><a href="abschliessen.php">
            <button class="btn btn-success">Bestellung abschliessen!</button>
          </a></div>
        </div>
      <?php } ?>
    </div>
<?php
}
?>