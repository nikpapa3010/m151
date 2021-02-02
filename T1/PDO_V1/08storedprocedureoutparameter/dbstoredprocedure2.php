<?php

require_once 'dbconfig.php';

$customerNumber = 103;
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // execute the stored procedure
    $sql = 'CALL GetCustomerLevel(:id,@level)';
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $customerNumber, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    // execute the second query to get customer's level
    $r = $conn->query("SELECT @level AS level")->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        echo sprintf('Customer #%d is %s', $customerNumber, $r['level']);
    }
} catch (PDOException $pe) {
    die("Error occurred:" . $pe->getMessage());
}

