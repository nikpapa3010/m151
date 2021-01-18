<?php
require_once("Auto.class.php");
require_once("Lastkraftwagen.class.php");
require_once("Sportwagen.class.php");
class Program2
{
	public function __construct(){
		$this -> main();
	}

  public function main(){
	  $a2 = new Sportwagen();
	  $a3 = new Lastkraftwagen();
	  
	  $a2->beschleunigen(100);
	  $a2->bremsen(55);
	  $a2->beschleunigen(100);
	  $a2->beschleunigen(100);
	  $a2->bremsen(100);
	  $a2->beschleunigen(100);
	  $a2->bremsen(55);
	  
	  $a3->beschleunigen(100);
	  $a3->bremsen(55);
	  $a3->beschleunigen(100);
	  $a3->bremsen(50);
	  $a3->bremsen(55);
	  

	  }
}
new Program2();
?>
