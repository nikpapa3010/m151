<?php
class Auto {
    //ein Attribut, eine Eigenschaft
    private $geschwindigkeit = 0;

    protected function setGeschwindigkeit($geschwindigkeit){
			$this->geschwindigkeit=$geschwindigkeit;
    }

    protected function getGeschwindigkeit(){
			return $this->geschwindigkeit;
    }
    

    //zum Bremsen
    public function bremsen($aenderung) {
			if ($this->geschwindigkeit - $aenderung < 0) {
					$this->geschwindigkeit = 0;
			}
			else {
					$this->geschwindigkeit =
					$this->geschwindigkeit - $aenderung;
			}
			echo "Die aktuelle Geschwindigkeit beträgt "
					.$this->geschwindigkeit ."<br />";
    }

    //zum Gasgeben
    public function beschleunigen($aenderung) {
			$this->geschwindigkeit =
			$this->geschwindigkeit + $aenderung;
			echo "Die aktuelle Geschwindigkeit beträgt "
					.$this->geschwindigkeit ."<br />";
    }
}
?>