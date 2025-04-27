<?php
header('Content-Type: application/json');

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
  echo json_encode(['error' => $e->getMessage()]);
  exit;
}

$clubMemberNumber = $_GET['clubMemberNumber'] ?? null;
if (!$clubMemberNumber) {
  echo json_encode(['error' => 'No Club Member Number provided.']);
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM ClubMembers WHERE clubMemberNumber = ?");
$stmt->execute([$clubMemberNumber]);
$member = $stmt->fetch();

if ($member) {
  echo json_encode($member);
} else {
  echo json_encode(['error' => 'No member found with that Club Member Number.']);
}
?>
