<?php
function drawMietauswahlView($mietobjekte) {
?>
    <div class="transbox">
      <h1>Mietobjekt auswählen</h1>

      <form action='mietabschluss.php' method="POST" class="row">
        <?php foreach ($mietobjekte as $mietobjekt) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3 text-center my-3">
          <img src="<?php echo $mietobjekt->BildLink; ?>" width="100%" />
          <?php echo $mietobjekt->Objekttyp; ?><br />
          Grössen: <?php echo $mietobjekt->KoerpergroesseVon . "-" .
            $mietobjekt->KoerpergroesseBis; ?> cm<br />
          Preis: CHF <?php echo number_format($mietobjekt->PreisProTag * $_SESSION['dauer'] *
            $_SESSION['menge'], 2, '.', '\'') ?><br />
          <button class="btn btn-primary" type="submit" name="submit" value="<?php echo
            $mietobjekt->MietobjektID; ?>">bestellen!</button>
        </div>
        <?php } ?>
      </form>
    </div>
<?php
}
?>