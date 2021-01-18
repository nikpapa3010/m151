<?php
require_once("Auto.class.php");

class Program
{
	public function __construct(){
		$this -> main();
	}

  public function main(){
	  $a1 = new Auto();
	  $a1->beschleunigen(100);
	  $a1->bremsen(55);
	  $a1->bremsen(55);
	  
	  

	  }
}
new Program();
?>
