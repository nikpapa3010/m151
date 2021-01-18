<?php
session_start();
require_once("Kunde.class.php");
require_once("Mitarbeiter.class.php");


class Program
{
	public function __construct(){
		$this -> main();
	}

  private function main(){
      require_once("lib/res/kopf.txt");
      require_once("lib/res/formular.txt");
      // Auswahl Kunde
      $kunde = array();
      try {
          $pdo = new PDO (
              'mysql:dbname=oophp;host=localhost;charset=utf8',
              'root', '' );
      } catch ( PDOException $e ) {
          die ( "Es ist ein Fehler aufgetreten!" );
      }
      $id = 2;
      if ($stmt = $pdo->prepare ( "SELECT * FROM kunde WHERE id=:id" )) {
          $stmt->bindParam ( ':id', $id );
          $stmt->execute ();
          $data = $stmt->fetchAll ();
      }
      for($i = 0; $i < $stmt->rowCount(); $i++){
          for($j = 0; $j < $stmt->columnCount(); $j++){
              $kunde[$j] = $data[$i][$j];
          }

      }
      // Abfrage Kontostand
      $id= $kunde[6];  //Foreign Key der Entität kunde - das zugeordnete Konto
      if ($stmt = $pdo->prepare ( "SELECT * FROM Konto WHERE id=:id" )) {
          $stmt->bindParam ( ':id', $id );
          $stmt->execute ();
          $data = $stmt->fetchAll ();
      }
      for($i = 0; $i < $stmt->rowCount(); $i++){
          $kontostand = $data[$i]['kontostand'];
          $kontotyp = $data[$i]['kontotyp'];
          
      }

      $konto1 = new Privatkonto(floatval($kontostand), $kontotyp);
      $kunde1 = new Kunde($kunde[1], $kunde[2], intVal($kunde[3]), $kunde[4], $kunde[5], $konto1);
      
      if( isset($_POST['betrag']) )
      {
          $meldung = $konto1-> auszahlen(floatval($_POST['betrag']));
          // Den Kontostand aktualisieren
          $kontostand = $konto1->getKontostand();
          $sql = "UPDATE konto SET kontostand = :kontostand WHERE id = :id";
          if ($stmt = $pdo->prepare ($sql)) {
              $stmt->bindParam ( ':id', $id );
              $stmt->bindParam ( ':kontostand', $kontostand );
              $stmt->execute ();
          }
         
          
      }
      else    {
          
          $meldung = "Der Kontostand beträgt aktuell ". $konto1->getKontostand() . " EUR.";
      
          
      }
      echo "<div id='info'>$meldung </div>";
      
      
      
      
      require_once("lib/res/ende.txt");
  }
}
new Program();
?>
