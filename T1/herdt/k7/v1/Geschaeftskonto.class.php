<?php
require_once("Konto.class.php");
require_once ("IGeschaeftsKonditionen.interface.php");
class Geschaeftskonto extends Konto implements IGeschaeftsKonditionen
{

    public function __construct(float $kontostand, string $kontotyp)
    {
        parent::__construct($kontostand, $kontotyp);
    }
    
    public function auszahlen(float $betrag)
    {
        if($this->kontostand - $betrag >= 0) {
            $this->kontostand -= $betrag;
            return "Der gewünschte Betrag $betrag EUR wurde ausgezahlt. Ihr neuer Kontostand beträgt " . $this -> getKontostand() . " EUR. " . 
                "Für den positiven Einlageebetrag erhalten Sie Zinsen in Höhe von " .IGeschaeftsKonditionen::ZINSSATZ. "%<br />";
        }
        else if($this->kontostand - $betrag >= -IGeschaeftsKonditionen::KREDITLIMIT) {
            $this->kontostand -= $betrag;
            return "Der gewünschte Betrag $betrag EUR wurde ausgezahlt. Ihr neuer Kontostand beträgt " . $this -> getKontostand() . " EUR. " .
                "Sie nutzen für den negativen Betrag einen Dispokredit von " .IGeschaeftsKonditionen::DISPOZINS . "%<br />";
            
        }
        else if($this->kontostand - $betrag < -IGeschaeftsKonditionen::KREDITLIMIT) {
            return "Ihr Disporahmen ist überschritten. Der gewünschte Betrag kann nicht ausgezahlt werden.<hr />";
        }
    }
}
?>
