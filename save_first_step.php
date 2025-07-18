<?php
header('Content-Type: application/json');
session_start();
if (session_status() !== PHP_SESSION_ACTIVE) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur de session'
    ]);
    exit;
}
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=pssfp_candidatures', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $data = [
        'specialite' => $_POST['specialite'] ?? null,
        'type_etude' => $_POST['type_etude'] ?? null,
        'premiere_langue' => $_POST['premiere_langue'] ?? null,
        'civilite' => $_POST['civilite'] ?? null,
        'nom' => $_POST['nom'] ?? null,
        'prenom' => $_POST['prenom'] ?? null,
        'epouse' => $_POST['epouse'] ?? null,
        'date_naissance' => $_POST['date_naissance'] ?? null,
        'lieu_naissance' => $_POST['lieu_naissance'] ?? null,
        'statut_matrimonial' => $_POST['statut_matrimonial'] ?? null
    ];

    // Gérer le fichier photo
    $photoPath = null;
    if (isset($_FILES['photo'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $photoPath = $uploadDir . $filename;
        
        move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
    }

    // Insérer les données dans la base
    $stmt = $pdo->prepare("
        INSERT INTO candidats (
            specialite, type_etude, premiere_langue, civilite, nom, prenom, epouse, 
            date_naissance, lieu_naissance, statut_matrimonial, photo, date_inscription
        ) VALUES (
            :specialite, :type_etude, :premiere_langue, :civilite, :nom, :prenom, :epouse, 
            :date_naissance, :lieu_naissance, :statut_matrimonial, :photo, NOW()
        )
    ");

    $stmt->execute(array_merge($data, ['photo' => $photoPath]));
    
    // Récupérer l'ID du candidat inséré
    $candidateId = $pdo->lastInsertId();

    // Générer le numéro de candidat manuellement (le trigger ne sera plus utilisé)
    $numeroCandidat = 'P13025-' . $candidateId;
    
    // Mettre à jour le numéro de candidat
    $stmt = $pdo->prepare("UPDATE candidats SET numero_candidat = ? WHERE id = ?");
    $stmt->execute([$numeroCandidat, $candidateId]);

    // Stocker temporairement les infos pour les étapes suivantes
    $_SESSION['temp_candidate_id'] = $candidateId;
    $_SESSION['temp_numero_candidat'] = $numeroCandidat;

    echo json_encode([
        'success' => true,
        'candidateId' => $candidateId,
        'numeroCandidat' => $numeroCandidat,
        'message' => 'Données enregistrées. Veuillez compléter les informations de contact.'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur: ' . $e->getMessage()
    ]);
}
