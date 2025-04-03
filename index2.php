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
    echo "Connected successfully to the database & Family Table!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop if we can't connect
}

//--5) Retrieve the data from the form
$familyMCN         = $_POST['familyMCN']   ?? null;
$familySSN         = $_POST['familySSN']    ?? null;
$familyFirstName   = $_POST['familyFirstName'] ?? null;
$familyLastName    = $_POST['familyLastName']       ?? null;
$familyDateOfBirth = $_POST['familyDateOfBirth']     ?? null;
$familyEmail       = $_POST['familyEmail']    ?? null;
$familyPhone       = $_POST['familyPhone']        ?? null;
$familyAddress     = $_POST['familyAddress']  ?? null;
$familyPostalCode  = $_POST['familyPostalCode']         ?? null;
$familyCity        = $_POST['familyCity']   ?? null;
$familyProvince    = $_POST['familyProvince']      ?? null;

//--6) Actually inserting into the DB
try {
    $sql = "INSERT INTO familyMember (
                MCN,
                SSN,
                firstName,
                lastName,
                Birthdate,
                email,
                telephoneNumber,
                address,
                postalCode,
                city,
                province
            ) VALUES (
                :familyMCN,
                :familySSN,
                :familyFirstName,
                :familyLastName,
                :familyDateOfBirth,
                :familyEmail,
                :familyPhone,
                :familyAddress,
                :familyPostalCode,
                :familyCity,
                :familyProvince
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':familyMCN'        => $familyMCN,
        ':familySSN'        => $familySSN,
        ':familyFirstName'  => $familyFirstName,
        ':familyLastName'   =>$familyLastName,
        ':familyDateOfBirth'=> $familyDateOfBirth,
        ':familyEmail'      => $familyEmail,
        ':familyPhone'      => $familyPhone,
        ':familyAddress'    => $familyAddress,
        ':familyPostalCode' => $familyPostalCode,
        ':familyCity'       => $familyCity,
        ':familyProvince'   => $familyProvince,
    ]);

    echo "<p>New family member record inserted successfully!</p>";
} catch (PDOException $e) {
    echo "<p>Error inserting family record: " . $e->getMessage() . "</p>";
}
?>
