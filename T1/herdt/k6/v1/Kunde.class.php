<?php
require_once("Person.class.php");
require_once("Privatkonto.class.php");
require_once("Geschaeftskonto.class.php");
 
class Kunde extends Person
{
  private $konto = null;

   public function __construct(string $vorname, string $nachname, int $alter, string $geschlecht, string $adresse, Konto $konto) {
    parent :: __construct($vorname, $nachname, $alter, $geschlecht, $adresse);
 
    $this -> konto = $konto;
  }
  
  public function getKonto(): Konto{
    return $this -> konto;
  }


    public function geschaeftsvorfall(){
	  return "Bisheriger Kontostand: " . $this -> getKonto() -> getKontostand() . " EUR.<br />";
	  $this -> kommunizieren("Kontakt zwischen Kunde und Mitarbeiter.");
	  $this -> konto ->auszahlen(100);
	  return "Neuer Kontostand: " . $this -> konto ->getKontostand() . " EUR.<br />";

  }
}
?>
