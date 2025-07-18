<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['temp_candidate_id']) || !isset($_SESSION['temp_numero_candidat'])) {
    $candidateId = $_POST['candidate_id'] ?? null;
    
    if (!$candidateId) {
        echo json_encode([
            'success' => false, 
            'message' => 'Session expirée ou invalide. Veuillez recharger la page.'
        ]);
        exit;
    }
    $_SESSION['temp_candidate_id'] = $candidateId;
    $_SESSION['temp_numero_candidat'] = 'P13025-' . $candidateId;
}
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=pssfp_candidatures', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['temp_candidate_id'])) {
        throw new Exception('Session invalide');
    }

    $candidateId = $_SESSION['temp_candidate_id'];
    $numeroCandidat = $_SESSION['temp_numero_candidat'];
    $data = [
        'id' => $candidateId,
        'pays_origine' => $_POST['pays_origine'] ?? null,
        'pays_residence' => $_POST['pays_residence'] ?? null,
        'region' => $_POST['region'] ?? null,
        'departement' => $_POST['departement'] ?? null,
        'adresse' => $_POST['adresse'] ?? null,
        'ville_residence' => $_POST['ville_residence'] ?? null,
        'telephone1' => $_POST['telephone1'] ?? null,
        'telephone2' => $_POST['telephone2'] ?? null,
        'email' => $_POST['email'] ?? null,
        'indicatif1' => $_POST['indicatif1'] ?? null,
        'indicatif2' => $_POST['indicatif2'] ?? null,
        'diplome_obtenu' => $_POST['diplome_obtenu'] ?? null,
        'institut' => $_POST['institut'] ?? null,
        'specialite_diplome' => $_POST['specialite_diplome'] ?? null,
        'annee_diplome' => $_POST['annee_diplome'] ?? null,
        'statut_actuel' => $_POST['statut_actuel'] ?? null,
        'employeur' => $_POST['employeur'] ?? null,
        'adresse_employeur2' => $_POST['adresse_employeur2'] ?? null,
        'tel_employeur' => $_POST['tel_employeur'] ?? null,
        'email_admin' => $_POST['email_admin'] ?? null,
        'moyen_connaissance' => $_POST['moyen_connaissance'] ?? null,
        'engagement_nom' => $_POST['engagement_nom'] ?? null,
        'mode_paiement' => $_POST['mode_paiement'] ?? null
    ];
    $setParts = [];
    $params = [':id' => $data['id']];
    
    foreach ($data as $key => $value) {
        if ($key !== 'id' && $value !== null) {
            $setParts[] = "`$key` = :$key";
            $params[":$key"] = $value;
        }
    }

    if (!empty($setParts)) {
        $sql = "UPDATE candidats SET " . implode(', ', $setParts) . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    if (!empty($_POST['telephone1'])) {
        $password = ($_POST['indicatif1'] ?? '') . ($_POST['telephone1'] ?? '');
        
        // Vérifier si le compte existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE candidat_id = ?");
        $stmt->execute([$candidateId]);
        
        if ($stmt->rowCount() === 0) {
            $userStmt = $pdo->prepare("INSERT INTO users (username, password, role, candidat_id, created_at) 
                                      VALUES (?, ?, 'candidat', ?, NOW())");
            $userStmt->execute([
                $numeroCandidat, 
                password_hash($password, PASSWORD_DEFAULT), 
                $candidateId
            ]);
            
            // Mettre à jour la session
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $numeroCandidat;
            $_SESSION['role'] = 'candidat';
            $_SESSION['candidat_id'] = $candidateId;
            
            // Nettoyer les données temporaires
            unset($_SESSION['temp_candidate_id']);
            unset($_SESSION['temp_numero_candidat']);
        }
    }

    echo json_encode([
    'success' => true,
    'message' => 'Candidat mis à jour',
    'redirect_url' => 'recapitulatif.php?id=' . $candidateId
]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}