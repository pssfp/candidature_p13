<?php
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=127.0.0.1;dbname=pssfp_candidatures', 'root', '');

$region = $_GET['region'];
$query = "SELECT departement FROM departement WHERE region = ? ORDER BY departement";
$stmt = $pdo->prepare($query);
$stmt->execute([$region]);
$departements = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($departements);
?>