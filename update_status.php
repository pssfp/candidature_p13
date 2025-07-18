<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'auth.php';

header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'] ?? 0;
    $statut = $_POST['statut'] ?? '';

    if (!$id || !in_array($statut, ['postulant', 'candidat'])) {
        throw new Exception('Paramètres invalides');
    }

    $stmt = $pdo->prepare("UPDATE candidats SET statut = ? WHERE id = ?");
    if ($stmt->execute([$statut, $id])) {
        echo json_encode([
            'success' => true,
            'message' => 'Statut mis à jour avec succès'
        ]);
    } else {
        throw new Exception('Échec de la mise à jour en base de données');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
exit;