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
    echo "Connected successfully to the database & Client Table!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop if we can't connect
}

//--5) Retrieve the data from the form
$firstName   = $_POST['firstName']   ?? null;
$lastName    = $_POST['lastName']    ?? null;
$dateOfBirth = $_POST['dateOfBirth'] ?? null;
$email       = $_POST['email']       ?? null;
$address     = $_POST['address']     ?? null;
$province    = $_POST['province']    ?? null;
$city        = $_POST['city']        ?? null;
$postalCode  = $_POST['postalCode']  ?? null;
$age         = $_POST['age']         ?? null;
$clientSex   = $_POST['clientSex']   ?? null;
$height      = $_POST['height']      ?? null;
$weight      = $_POST['weight']      ?? null;
$clientPhone = $_POST['clientPhone'] ?? null;
$clientSSN   = $_POST['clientSSN']   ?? null;
$clientMCN   = $_POST['clientMCN']   ?? null;

//--6) Actually inserting into the DB
try {
    $sql = "INSERT INTO ClubMembers (
                firstName,
                lastName,
                email,
                Age,
                dateOfBirth,
                Height,
                Weight,
                isActive,
                Address,
                postalCode,
                City,
                Province,
                MCN,
                SSN,
                telephoneNumber,
                Sex
            ) VALUES (
                :firstName,
                :lastName,
                :email,
                :age,
                :dateOfBirth,
                :height,
                :weight,
                :isActive,
                :address,
                :postalCode,
                :city,
                :province,
                :clientMCN,
                :clientSSN,
                :clientPhone,
                :clientSex
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':firstName'   => $firstName,
        ':lastName'    => $lastName,
        ':email'       => $email,
        ':age'         => $age,
        ':dateOfBirth' => $dateOfBirth,
        ':height'      => $height,
        ':weight'      => $weight,
        ':isActive'    => 1,
        ':address'     => $address,
        ':postalCode'  => $postalCode,
        ':city'        => $city,
        ':province'    => $province,
        ':clientMCN'   => $clientMCN,
        ':clientSSN'   => $clientSSN,
        ':clientPhone' => $clientPhone,
        ':clientSex'   => $clientSex
    ]);

    echo "<p>New member record inserted successfully!</p>";
} catch (PDOException $e) {
    echo "<p>Error inserting record: " . $e->getMessage() . "</p>";
}
?>
