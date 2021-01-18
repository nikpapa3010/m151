<?php
try {
	$pdo = new PDO (
			'mysql:dbname=oophp;host=localhost;charset=utf8',
			'root', '' );
} catch ( PDOException $e ) {
	die ( "Es ist ein Fehler aufgetreten!" );
}
if ($stmt = $pdo->query ( "SELECT * FROM kunde" )) {
	$data = $stmt->fetchAll ();
}
for($i = 0; $i < $stmt->rowCount(); $i++){
    for($j = 0; $j < $stmt->columnCount(); $j++){
    echo $data[$i][$j] . "; ";
    }
    echo "<br />";
}
?>
