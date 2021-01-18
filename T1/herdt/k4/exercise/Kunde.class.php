<?php
require_once("Konto.class.php");
class Kunde
{
  private $vorname = "";
  private $nachname = "";
  private $alter = 0;
  private $geschlecht = "";
  private $adresse = "";
  private $konto = null;
 
  public function __construct(string $vorname, string $nachname, int $alter, string $geschlecht, string $adresse, Konto $konto) 
  {
    $this-> setVorname($vorname);
    $this-> setNachname($nachname);
    $this-> setAlter($alter);
    $this-> setGeschlecht($geschlecht);
    $this-> setAdresse($adresse);
    $this -> konto = $konto;
 

    
  }
  public function __destruct() {
		echo "<br />Objekt mit dem Namen " . $this -> vorname . " " . $this -> nachname ." wird gel&ouml;scht...";
  }

  

  public function setVorname(string $vorname)
  {
    $this -> vorname = $vorname;
  }
  public function getVorname(): string 
  {
    return $this -> vorname;
  }

  public function setNachname(string $nachname)
  {
    $this -> nachname = $nachname;
  }
  public function getNachname(): string
  {
    return $this -> nachname;
  }

  public function setAlter(int $alter)
  {
    $this -> alter = $alter;
  }
  public function  getAlter(): int
  {
    return $this -> alter;
  }

  public function setGeschlecht(string $geschlecht)
  { 
    $this -> geschlecht = $geschlecht;
  }
  public function getGeschlecht(): string
  {
    $this -> geschlecht;
  }

  public function setAdresse(string $adresse) 
  {
    $this -> adresse = $adresse;
  }
  public function getAdresse(): string
  {
    return $this -> adresse;
  }

  public function getKonto()
  {
    return $this -> konto;
  }


}
?>
