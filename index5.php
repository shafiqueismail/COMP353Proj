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
    echo "Connected successfully to the database & Secondary Family Table!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop if we can't connect
}

//--5) Retrieve the data from the form
$secondaryMCN         = $_POST['secondaryMCN']   ?? null;
$secondarySSN         = $_POST['secondarySSN']    ?? null;
$secondaryDateOfBirth   = $_POST['secondaryDateOfBirth'] ?? null;
$secondaryFirstName    = $_POST['secondaryFirstName']       ?? null;
$secondaryLastName = $_POST['secondaryLastName']     ?? null;
$secondaryAddress       = $_POST['secondaryAddress']    ?? null;
$secondaryPhone       = $_POST['secondaryPhone']        ?? null;
$secondaryCity     = $_POST['secondaryCity']  ?? null;
$secondaryProvince  = $_POST['secondaryProvince']         ?? null;
$secondaryPostalCode        = $_POST['secondaryPostalCode']   ?? null;
$secondaryEmail    = $_POST['secondaryEmail']      ?? null;

//--6) Actually inserting into the DB
try {
    $sql = "INSERT INTO SecondaryFamilyMember (
                MCN,
                SSN,
                Birthdate,
                First_Name,
                Last_Name,
                Address,
                Telephone_number,
                City,
                Province,
                Postal_code,
                Email
            ) VALUES (
                :secondaryMCN,
                :secondarySSN,
                :secondaryDateOfBirth,
                :secondaryFirstName,
                :secondaryLastName,
                :secondaryAddress,
                :secondaryPhone,
                :secondaryCity,
                :secondaryProvince,
                :secondaryPostalCode,
                :secondaryEmail
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':secondaryMCN'        => $secondaryMCN,
        ':secondarySSN'        => $secondarySSN,
        ':secondaryDateOfBirth'  => $secondaryDateOfBirth,
        ':secondaryFirstName'   =>$secondaryFirstName,
        ':secondaryLastName'=> $secondaryLastName,
        ':secondaryAddress'      => $secondaryAddress,
        ':secondaryPhone'      => $secondaryPhone,
        ':secondaryCity'    => $secondaryCity,
        ':secondaryProvince' => $secondaryProvince,
        ':secondaryPostalCode'       => $secondaryPostalCode,
        ':secondaryEmail'   => $secondaryEmail
    ]);

    echo "<p>New secondary family member record inserted successfully!</p>";
} catch (PDOException $e) {
    echo "<p>Error inserting secondary family record: " . $e->getMessage() . "</p>";
}
?>
