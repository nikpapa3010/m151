<?php

require_once "allebenutzer.class.php";

$host = 'localhost';
$dbname = 'ski_service';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql = $pdo->prepare("select * from AlleBenutzer");

if ($sql->execute()) {
  echo "<h1>Fetch-Methoden</h1>";
  echo "<h2>fetch</h2>[";
  echo implode(", ", $sql->fetch());
  echo "]";

  echo "<h2>fetchColumn</h2>";
  echo $sql->fetchColumn(2);

  echo "<h2>fetchObject</h2>";
  echo $sql->fetchObject("allebenutzer");

  echo "<h2>fetchAll</h2>";
  foreach ($sql->fetchAll() as $k) {
    echo implode(", ", $k) . "<br />";
  }
}

if ($sql->execute()) {
  echo "<h1>Fetch-Modi</h1>";

  echo "<h2>PDO::FETCH_ASSOC</h2>";
  $arr = $sql->fetch(PDO::FETCH_ASSOC);
  echo implode(", ", $arr);
  echo $arr["UserID"];

  echo "<h2>PDO::FETCH_NUM</h2>";
  $arr = $sql->fetch(PDO::FETCH_NUM);
  echo implode(", ", $arr);
  echo $arr[0];

  echo "<h2>PDO::FETCH_BOTH</h2>";
  $arr = $sql->fetch(PDO::FETCH_BOTH);
  echo implode(", ", $arr);

  echo "<h2>PDO::FETCH_BOUND</h2>";
  $userID = 0;
  $benutzername = "";
  $telnr = "";
  $email = "";
  $sql->bindColumn("UserID", $userID);
  $sql->bindColumn("Benutzername", $benutzername);
  $sql->bindColumn("Telefonnummer", $telnr);
  $sql->bindColumn("Email", $email);
  $sql->fetch(PDO::FETCH_BOUND);
  echo "UserID: $userID<br />";
  echo "Benutzername: $benutzername<br />";
  echo "Telefonnummer: $telnr<br />";
  echo "Email: $email<br />";

  echo "<h2>PDO::FETCH_CLASS</h2>";
  $sql->setFetchMode(PDO::FETCH_CLASS, "allebenutzer");
  echo $sql->fetch();

  echo "<h2>PDO::FETCH_OBJ</h2>";
  $sql->setFetchMode(PDO::FETCH_OBJ);
  $kaka = $sql->fetch();
  echo $kaka->UserID;
  
  echo "<h2>PDO::FETCH_INTO</h2>";
  $sql->setFetchMode(PDO::FETCH_INTO, $kaka);
  $kaka = $sql->fetch();
  echo $kaka->UserID;
}

?>