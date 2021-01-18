<?php
require_once("Auto.class.php");

 class LKW extends Auto
 {
     private $hoechstgeschwindigkeit = 150;


     
    

    
    //zum Bremsen
    public function bremsen($aenderung) 
{
        if ($this->getGeschwindigkeit() - $aenderung < 0) 
        {
                $this->getG = 0;
        }
        else 
        {
                $this->hoechstgeschwindigkeit =
                $this->hoechstgeschwindigkeit - $aenderung;
        }
        echo "Die aktuelle Geschwindigkeit beträgt "
                .$this->hoechstgeschwindigkeit ."<br />";
}

//zum Gasgeben
public function beschleunigen($aenderung)
{
        if($this->getGeschwindigkeit() + $aenderung < $this->hoechstgeschwindigkeit)
        {
            $this->setGeschwindigkeit($this->getGeschwindigkeit() + $aenderung);
            echo "Die hoechstgeschwindigkeit ist " .$this->hoechstgeschwindigkeit ." <br/>";
        }
        else
        {
    
            $this->setGeschwindigkeit($this->hoechstgeschwindigkeit);

            echo "Die maximale Geschwindigkeit beträgt " .$this->hoechstgeschwindigkeit ."<br />";

        }



}
 }
?>