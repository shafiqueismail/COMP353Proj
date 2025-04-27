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
    echo "Connected successfully to the database & Personnel Table!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit; // Stop if we can't connect
}

//--5) Retrieve the data from the form
$personnelFirstName         = $_POST['personnelFirstName']   ?? null;
$personnelLastName         = $_POST['personnelLastName']    ?? null;
$personnelDateOfBirth   = $_POST['personnelDateOfBirth'] ?? null;
$personnelSSN    = $_POST['personnelSSN']       ?? null;
$personnelMCN = $_POST['personnelMCN']     ?? null;
$personnelPhone       = $_POST['personnelPhone']    ?? null;
$personnelAddress       = $_POST['personnelAddress']        ?? null;
$personnelCity     = $_POST['personnelCity']  ?? null;
$personnelProvince  = $_POST['personnelProvince']         ?? null;
$personnelPostalCode        = $_POST['personnelPostalCode']   ?? null;
$personnelEmail    = $_POST['personnelEmail']  ?? null;
$personnelMandate = $_POST['personnelMandate'] ?? null;
$personnelLocationID = $_POST['personnelLocationID'] ?? null;
$personnelRole = $_POST['personnelRole'] ?? null;


//--6) Actually inserting into the DB
try {
    $sql = "INSERT INTO Personnel (
                firstName,
                lastName,
                dateOfBirth,
                SSN,
                MCN,
                telephone,
                address,
                city,
                province,
                postalCode,
                emailAddress,
                mandate,
                locationID,
                role
            ) VALUES (
                :personnelFirstName,
                :personnelLastName,
                :personnelDateOfBirth,
                :personnelSSN,
                :personnelMCN,
                :personnelPhone,
                :personnelAddress,
                :personnelCity,
                :personnelProvince,
                :personnelPostalCode,
                :personnelEmail,
                :personnelMandate,
                :personnelLocationID,
                :personnelRole
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':personnelFirstName'        => $personnelFirstName,
        ':personnelLastName'        => $personnelLastName,
        ':personnelDateOfBirth'  => $personnelDateOfBirth,
        ':personnelSSN'   =>$personnelSSN,
        ':personnelMCN'=> $personnelMCN,
        ':personnelPhone'      => $personnelPhone,
        ':personnelAddress'      => $personnelAddress,
        ':personnelCity'    => $personnelCity,
        'personnelProvince' =>$personnelProvince,
        ':personnelPostalCode' => $personnelPostalCode,
        ':personnelEmail'       => $personnelEmail,
        ':personnelMandate'   => $personnelMandate,
        ':personnelLocationID'   => $personnelLocationID,
        ':personnelRole'   => $personnelRole,
    ]);

    echo "<p>New personnel record inserted successfully!</p>";
} catch (PDOException $e) {
    echo "<p>Error inserting personnel record: " . $e->getMessage() . "</p>";
}
?>
