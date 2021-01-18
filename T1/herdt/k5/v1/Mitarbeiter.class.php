<?php

class Mitarbeiter
{
  private $vorname = "";
  private $nachname = "";
  private $alter = 0;
  private $geschlecht = "";
  private $adresse = "";
  private $personalnr = 0;
 
  public function __construct(string $vorname, string $nachname, int $alter, string $geschlecht, string $adresse, int $personalnr) {
  $this -> setVorname($vorname);
  $this -> setNachname($nachname);
  $this -> setAlter($alter);
  $this -> setGeschlecht($geschlecht);
  $this -> setAdresse($adresse);
  $this -> setPersonalnr($personalnr);
  }
  
    public function setVorname(string $vorname){
    $this -> vorname = $vorname;
  }
  public function getVorname(): string{
    return $this -> vorname;
  }

    public function setNachname(string $nachname){
    $this -> nachname = $nachname;
  }
  public function getNachname(): string{
    return $this -> nachname;
  }
      public function setAlter(int $alter){
    $this -> alter = $alter;
  }
  public function getAlter(): int{
    return $this -> alter;
  }
      public function setGeschlecht(string $geschlecht){
    $this -> geschlecht = $geschlecht;
  }
  public function getGeschlecht(): string{
    return $this -> geschlecht;
  }
      public function setAdresse(string $adresse){
    $this -> adresse = $adresse;
  }
  public function getAdresse(): string{
    return $this -> adresse;
  }
      public function setPersonalnr(string $personalnr){
    $this -> personalnr = $personalnr;
  }
  public function getPersonalnr(): string{
    return $this -> personalnr;
  }

  public function __destruct() {
		echo "<br />Objekt mit dem Namen " . $this -> vorname . " " . $this -> nachname ." wird gel&ouml;scht...";
  }

}
?>
