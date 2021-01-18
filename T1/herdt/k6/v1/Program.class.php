<?php
require_once("Kunde.class.php");
require_once("Mitarbeiter.class.php");


class Program
{
	public function __construct(){
		$this -> main();
	}

  private function main(){
	  $konto1 = new Privatkonto(floatval("1023.34"), "Girokonto");
	  $kunde1 = new Kunde("Hans", "Dampf", 42, "Mann", "12345 Irgendwo, Irgendeinestrasse 42", $konto1);
	  echo "Allgemeiner Geschäftsvorfall von " .  $kunde1->getVorname() . " " . $kunde1->getNachname() . "<br />";
	  echo $kunde1 -> geschaeftsvorfall();
	  echo "Auszahlungsvorfall von " . $kunde1->getVorname() . " " . $kunde1->getNachname() . "<br />";
	  echo $konto1-> auszahlen(1000);
	  echo "Auszahlungsvorfall von " . $kunde1->getVorname() . " " . $kunde1->getNachname() . "<br />";
	  echo $konto1-> auszahlen(1000);
	  
	  $konto2 = new Geschaeftskonto(floatval("1023.34"), "Girokonto");
	  $kunde2 = new Kunde("Otto", "Schmidt", 56, "Mann", "12345 Irgendwo, Irgendeinestrasse 2", $konto2);
	  echo "Auszahlungsvorfall von " . $kunde2->getVorname() . " " . $kunde2->getNachname() . "<br />";
	  
	  echo $konto2-> auszahlen(1000);
	  echo "Auszahlungsvorfall von " . $kunde2->getVorname() . " " . $kunde2->getNachname() . "<br />";
	  echo $konto2-> auszahlen(1000);
	  echo "Auszahlungsvorfall von " . $kunde2->getVorname() . " " . $kunde2->getNachname() . "<br />";
	  echo $konto2-> auszahlen(1000);
	  echo "Auszahlungsvorfall von " . $kunde2->getVorname() . " " . $kunde2->getNachname() . "<br />";
	  echo $konto2-> auszahlen(4000);
  }
}
new Program();
?>
