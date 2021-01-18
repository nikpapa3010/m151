<?php

class Konto
{
  private $kontostand = 0;
  private $kontotyp = "";


  public function __constructor(int $kontostand, string $kontotyp)
  {
    $this -> kontostand = $kontostand;
    $this -> kontotyp = $kontotyp;
  }

  public function getKontostand() :int
  {
    return $this -> kontostand;
  }
  
  public function getKontotyp() :string
  {
    return $this -> kontotyp;
  }
}
?>
