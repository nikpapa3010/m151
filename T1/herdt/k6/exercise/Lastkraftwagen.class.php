<?php
require_once("Auto.class.php");
class Lastkraftwagen extends Auto{
    private $hoechstgeschwindigkeit = 120;

    

    public function beschleunigen($aenderung) 
    {

        if ($this->getGeschwindigkeit() + $aenderung < $this->hoechstgeschwindigkeit) {
            $this->setGeschwindigkeit(
                $this->getGeschwindigkeit() + $aenderung);
            echo "Die aktuelle Geschwindigkeit des LKW beträgt "
                .$this->getGeschwindigkeit() ."<br />";
        }
        
        else{
            $this->setGeschwindigkeit($this->hoechstgeschwindigkeit);
            echo "Die maximale Geschwindigkeit des LKW beträgt "
                .$this->hoechstgeschwindigkeit ."<br /> ";
        }
    }

    public   function bremsen($aenderung)
    
    {
        if ($this->getGeschwindigkeit() - $aenderung < 0) {
            $this->getGeschwindigkeit(0);
        }
        else {
            $this->setGeschwindigkeit($this->getGeschwindigkeit() - $aenderung);
        }
        echo "Die aktuelle Geschwindigkeit beträgt "
            .$this->getGeschwindigkeit() ."<br />";
    }
}
?>