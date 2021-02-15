<?php
function drawMietauswahlView($mietobjekte) {
?>
    <div class="transbox">
      <h1>Mietobjekt auswählen</h1>

      <form action='mietabschluss.php' method="POST" class="row">
        <?php foreach ($mietobjekte as $mietobjekt) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          Objekttyp: <?php echo $mietobjekt->Objekttyp; ?><br />
          Grössen: <?php echo $mietobjekt->KoerpergroesseVon . "-" . $mietobjekt->KoerpergroesseBis; ?><br />
          Altersgruppe: <?php echo $mietobjekt->Altersgruppe; ?><br />
          Geschlecht: <?php echo $mietobjekt->Geschlecht; ?><br />
          Preis: <?php echo $mietobjekt->PreisProTag * $_SESSION['dauer'] ?><br />
          <button class="btn btn-primary" type="submit" name="submit" value="<?php echo $mietobjekt->MietobjektID; ?>">bestellen!</button>
        </div>
        <?php } ?>
      </form>
    </div>
<?php
}
?>