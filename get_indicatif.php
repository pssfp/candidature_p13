<?php
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;dbname=pssfp_candidatures', 'root', '');

$pays = $_GET['pays'];
$query = "SELECT indicatif FROM pays WHERE code_iso = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$pays]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($result ? $result : ['indicatif' => '']);
?>