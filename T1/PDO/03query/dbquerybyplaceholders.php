<?php
 
require_once 'dbconfig.php';
 
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 
    $sql = 'SELECT lastname, firstname, jobtitle 
            FROM employees
            WHERE lastname  LIKE :lname OR
                  firstname LIKE :fname';
 
    $q = $conn->prepare($sql);
    $q->execute(array(':f^^name' => 'Le%',
                      ':lname' => '%son'));
    $q->setFetchMode(PDO::FETCH_ASSOC);


    while ($r = $q->fetch()) {
        echo sprintf('%s <br/>', $r['lastname']);
    }
    
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}