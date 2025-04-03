<?php

//--1)connecting to the db
$host = 'yqc353.encs.concordia.ca'; 
$db   = 'yqc353_4';
$user = 'yqc353_4';
$pass = 'Moon9624';
$charset = 'utf8mb4';

//--2)build the DSN string
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//--3) Create the PDO
try {
    $pdo = new PDO($dsn, $user, $pass);
    // Optional: Setting PDO attributes to know when err. occurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //--4)using the connection
    echo "Connected successfully to the database & Location Table!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop if we can't connect
}

//--5) Retrieve the data from the form
$locationName         = $_POST['locationName']   ?? null;
$locationWebAddress         = $_POST['locationWebAddress']    ?? null;
$locationCapacity   = $_POST['locationCapacity'] ?? null;
$locationTelephone    = $_POST['locationTelephone']       ?? null;
$locationAddress = $_POST['locationAddress']     ?? null;
$locationCity       = $_POST['locationCity']    ?? null;
$locationProvince       = $_POST['locationProvince']        ?? null;
$locationPostalCode     = $_POST['locationPostalCode']  ?? null;

//--6) Actually inserting into the DB
try {
    $sql = "INSERT INTO Location (
                name,
                webAddress,
                maximumCapacity,
                telephoneNumber,
                Address,
                City,
                Province,
                postalCode
                
            ) VALUES (
                :locationName,
                :locationWebAddress,
                :locationCapacity,
                :locationTelephone,
                :locationAddress,
                :locationCity,
                :locationProvince,
                :locationPostalCode
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':locationName'        => $locationName,
        ':locationWebAddress'        => $locationWebAddress,
        ':locationCapacity'  => $locationCapacity,
        ':locationTelephone'   =>$locationTelephone,
        ':locationAddress'=> $locationAddress,
        ':locationCity'      => $locationCity,
        ':locationProvince'      => $locationProvince,
        ':locationPostalCode'    => $locationPostalCode
        
    ]);

    echo "<p>New Location record inserted successfully!</p>";
} catch (PDOException $e) {
    echo "<p>Error inserting location record: " . $e->getMessage() . "</p>";
}
?>
