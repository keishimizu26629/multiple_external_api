<?php
// 例：API 2のスクリプト

try {
    $pdo = new PDO('mysql:host=db;dbname=mockdb', 'user', 'password', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $name = $input['name'] ?? null;

    // テーブル名を修正
    $stmt = $pdo->prepare("SELECT key_value FROM api_keys WHERE site_name = ?");
    $stmt->execute([$name]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "No data found for name: $name"]);
    }
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>
