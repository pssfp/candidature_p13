<?php
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;dbname=pssfp_candidatures', 'root', '');

if ($_GET['pays'] === 'CM') {
    $query = "SELECT Region FROM region WHERE Region != 'Z AUTRES' ORDER BY Region";
    $stmt = $pdo->query($query);
    $regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($regions);
} else {
    echo json_encode([]);
}
?>