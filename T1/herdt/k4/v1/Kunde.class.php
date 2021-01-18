<?php

class Kunde
{
  private $vorname = "";
  private $nachname = "";
  private $alter = 0;
  private $geschlecht = "";
  private $adresse = "";


  public function __constructor(string $vorname, string $nachname, int $alter, string $geschlecht, string $adresse)
  {
    setVorname();
    setNachname();
    setAlter();
    setGeschlecht();
    setAdresse();
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
    $this -> adresse;
  }


  

}
?>
