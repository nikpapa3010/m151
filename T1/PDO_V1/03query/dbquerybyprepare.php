<?php
 
require_once 'dbconfig.php';
 
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 
    $sql = 'SELECT lastname, firstname, jobtitle 
            FROM employees
            WHERE lastname LIKE ?';
 
    $q = $conn->prepare($sql);
    $q->execute(array('%son'));
    $q->setFetchMode(PDO::FETCH_ASSOC);
 
    while ($r = $q->fetch()) {
        echo sprintf('%s <br/>', $r['lastname']);
    }
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}