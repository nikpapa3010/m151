<?php
require_once("Kunde.class.php");
class Program
{
	public function __construct(){
		$this -> main();
	}

	function __destruct() {
			echo "<br />Objekt wird gel&ouml;scht...";
	}


  private function main(){
	  $konto1 = new Konto(floatval("1023.34"), "Sparbuch");
	  $konto2 = clone $konto1;
	  $kunde1 = new Kunde("Hans", "Dampf", 42, "Mann", "12345 Irgendwo, Irgendeinestrasse 42", $konto1);
	  $kunde2 = clone $kunde1;
	  $kunde1 ->__construct ("Otto", "Dort", 23, "Mann", "12346 Irgendwas, Irgendeineanderestrasse 4711",$konto2);
	//   var_dump($kunde1);
	//   var_dump($kunde2);

	  echo $kunde2->getNachname(); 
	  echo"<br/>";
	  echo $kunde2->getVorname(); 
	  echo"<br/>";
	  echo $kunde2->getAdresse(); 
	  echo"<br/>";
  }
}
new Program();
?>
