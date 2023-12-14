<?php
// 例：API 1のスクリプト

try {
    $pdo = new PDO('mysql:host=db;dbname=mockdb', 'user', 'password', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // POSTリクエストのデータを取得
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    $id = $input['id'] ?? null; // Null合体演算子を使用

    // データベースからデータを取得
    $stmt = $pdo->prepare("SELECT name, created_at FROM sites WHERE id = ?");
    if ($stmt->execute([$id])) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            echo json_encode(["error" => "No data found for ID: $id"]);
        }
    } else {
        echo json_encode(["error" => "Query execution failed"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
