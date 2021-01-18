<?php
require_once("Kunde.class.php");
require_once("Auto.class.php");
require_once("Sportwagen.class.php");
require_once("LKW.class.php");
class Program
{
	public function __construct(){
		$this -> main();
	}

	function __destruct() {
			echo "<br />Objekt wird gel&ouml;scht...";
	}


  private function main(){
	//   $konto1 = new Konto(floatval("1023.34"), "Sparbuch");
	//   $konto2 = clone $konto1;
	//   $kunde1 = new Kunde("Hans", "Dampf", 42, "Mann", "12345 Irgendwo, Irgendeinestrasse 42", $konto1);
	//   $kunde2 = clone $kunde1;
	//   $kunde1 ->__construct ("Otto", "Dort", 23, "Mann", "12346 Irgendwas, Irgendeineanderestrasse 4711",$konto2);
	//   var_dump($kunde1);
	//   var_dump($kunde2);

	$a1 = new Auto();
	$a1->beschleunigen(100);
	$a1->bremsen(55);
	$a1->bremsen(55);

	$s1 = new Sportwagen();
	$s1->beschleunigen(300);
	$s1->bremsen(100);
   echo "<br/>";
	$LKW1 = new LKW();
	$LKW1->beschleunigen(200);
	$LKW1->bremsen(50);


	
  }
}
new Program();
?>
