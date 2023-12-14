<?php
// 例：API 3のスクリプト

$pdo = new PDO('mysql:host=db;dbname=mockdb', 'user', 'password', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$key = $input['key'] ?? null;

$stmt = $pdo->prepare("SELECT image_url FROM images WHERE key_value = ?");
$stmt->execute([$key]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($result);
?>
