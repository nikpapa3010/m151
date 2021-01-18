<?php

class allebenutzer {
  public $UserID = 0;
  public $Benutzername = "";
  public $Name = "";
  public $Email = "";
  public $Telefonnummer = "";
  public $Rang = "";

  public function __construct() {
    
  }

  public function __toString() {
    return "UserID: $this->UserID, Benutzername: $this->Benutzername, Name: $this->Name, " .
      "Email: $this->Email, Telefonnummer: $this->Telefonnummer, Rang: $this->Rang";
  }
}

?>