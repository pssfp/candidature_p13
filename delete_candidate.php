<?php
session_start();
require 'auth.php';
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'] ?? 0;

if ($id) {
    $pdo->exec("DELETE FROM users WHERE candidat_id = $id");
    
    // Puis supprimer le candidat
    $stmt = $pdo->prepare("DELETE FROM candidats WHERE id = ?");
    $stmt->execute([$id]);
    exit; 
}
exit; 