<?php
require_once '../Core/database.inc.php';
function accessUsers($username) : bool {
  $pdo = connect();
  $stmt = $pdo->prepare("select ShowAll from benutzer inner join Rang on Benutzer.RangID = Rang.RangID where benutzername = :un;");
  $stmt->execute([':un' => $username]);

  $fetched = $stmt->fetch();
  $showAll = $fetched["ShowAll"];
  return $showAll;
}
?>