<?php
// Database connection info
$host = 'yqc353.encs.concordia.ca'; 
$db   = 'yqc353_4';
$user = 'yqc353_4';
$pass = 'Moon9624';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
  die("Database connection error: " . $e->getMessage());
}

// Get the clubMemberNumber from the hidden form field
$clubMemberNumber = $_POST['clubMemberNumber'];

// Fields to update
$fields = [
  'firstName', 'lastName', 'email', 'Age', 'Sex',
  'dateOfBirth', 'Height', 'Weight', 'telephoneNumber',
  'SSN', 'address', 'City', 'Province', 'postalCode',
  'role', 'isActive'
];

// Collect the form data
$data = [];
foreach ($fields as $field) {
  $data[$field] = $_POST[$field] ?? null;
}

$stmt = $pdo->prepare("
  UPDATE ClubMembers 
  SET
    firstName = ?, lastName = ?, email = ?, Age = ?, Sex = ?,
    dateOfBirth = ?, Height = ?, Weight = ?, telephoneNumber = ?,
    SSN = ?, address = ?, City = ?, Province = ?, postalCode = ?,
    role = ?, isActive = ?
  WHERE clubMemberNumber = ?
");

$success = $stmt->execute([
  $data['firstName'], $data['lastName'], $data['email'], $data['Age'], $data['Sex'],
  $data['dateOfBirth'], $data['Height'], $data['Weight'], $data['telephoneNumber'],
  $data['SSN'], $data['address'], $data['City'], $data['Province'], $data['postalCode'],
  $data['role'], $data['isActive'],
  $clubMemberNumber
]);

if ($success) {
  echo "✅ Member information updated successfully.";
} else {
  echo "❌ Failed to update member information.";
}
?>
