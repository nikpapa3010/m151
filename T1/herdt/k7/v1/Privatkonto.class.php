<?php
require_once ("Konto.class.php");
require_once ("IPrivatKonditionen.interface.php");
class Privatkonto extends Konto implements IPrivatKonditionen
{

    public function __construct(float $kontostand, string $kontotyp)
    {
        parent::__construct($kontostand, $kontotyp);
    }

    public function auszahlen(float $betrag)
    {
        if($this->kontostand - $betrag >= 0) {
          $this->kontostand -= $betrag;
          return "Der gewünschte Betrag $betrag EUR wurde ausgezahlt. Ihr neuer Kontostand beträgt " . $this -> getKontostand() . " EUR.<br />";
        }
        else if($this->kontostand - $betrag >= -IPrivatKonditionen::KREDITLIMIT) {
            $this->kontostand -= $betrag;
            return "Der gewünschte Betrag $betrag EUR wurde ausgezahlt. Ihr neuer Kontostand beträgt " . $this -> getKontostand() . " EUR. " .
                "Sie nutzen für den negativen Betrag einen Dispokredit von " .IPrivatKonditionen::DISPOZINS . "%<br />";
            
        }
        else if($this->kontostand - $betrag < -IPrivatKonditionen::KREDITLIMIT) {
            return "Ihr Disporahmen ist überschritten. Der gewünschte Betrag kann nicht ausgezahlt werden.<hr />";
        }
    }
}
?>
