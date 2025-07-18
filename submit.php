<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function clean($data) {
            return htmlspecialchars(trim($data ?? ''));
        }

        $photoName = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $photoName = uniqid() . '_' . basename($_FILES['photo']['name']);
            $uploadFile = $uploadDir . $photoName;
            $allowedTypes = ['image/jpeg', 'image/png'];
            $fileType = mime_content_type($_FILES['photo']['tmp_name']);
            
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    // Fichier uploadé avec succès
                } else {
                    throw new Exception("Erreur lors de l'upload du fichier");
                }
            } else {
                throw new Exception("Type de fichier non autorisé. Seuls JPEG et PNG sont acceptés.");
            }
        }

        $numero_candidat = 'P' . date('y') . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);

        $telephone1 = clean($_POST['indicatif1']) . clean($_POST['telephone1']);
        $telephone2 = !empty($_POST['telephone2']) ? clean($_POST['indicatif2']) . clean($_POST['telephone2']) : null;

        // Récupération de tous les champs
        $data = [
            'specialite' => clean($_POST['specialite']),
            'type_etude' => clean($_POST['type_etude']),
            'civilite' => clean($_POST['civilite']),
            'nom' => clean($_POST['nom']),
            'prenom' => clean($_POST['prenom']),
            'epouse' => clean($_POST['epouse']),
            'date_naissance' => clean($_POST['date_naissance']),
            'lieu_naissance' => clean($_POST['lieu_naissance']),
            'region' => clean($_POST['region']),
            'departement' => clean($_POST['departement']),
            'nationalite' => clean($_POST['nationalite']),
            'statut_matrimonial' => clean($_POST['statut_matrimonial']),
            'nb_enfants' => clean($_POST['nb_enfants'] ?? 0),
            'pays_origine' => clean($_POST['pays_origine']),
            'pays_residence' => clean($_POST['pays_residence']),
            'adresse' => clean($_POST['adresse']),
            'ville_residence' => clean($_POST['ville_residence']),
            'indicatif1' => clean($_POST['indicatif1']),
            'telephone1' => $telephone1,
            'indicatif2' => clean($_POST['indicatif2']),
            'telephone2' => $telephone2,
            'email' => clean($_POST['email']),
            'diplome_obtenu' => clean($_POST['diplome_obtenu']),
            'institut' => clean($_POST['institut']),
            'specialite_diplome' => clean($_POST['specialite_diplome']),
            'annee_diplome' => clean($_POST['annee_diplome']),
            'statut_actuel' => clean($_POST['statut_actuel']),
            'employeur' => clean($_POST['employeur']),
            'adresse_employeur2' => clean($_POST['adresse_employeur2']),
            'tel_employeur' => clean($_POST['tel_employeur']),
            'email_admin' => clean($_POST['email_admin']),
            'moyen_connaissance' => clean($_POST['moyen_connaissance']),
            'engagement_nom' => clean($_POST['engagement_nom']),
            'mode_paiement' => clean($_POST['mode_paiement']),
            'photo' => $photoName,
            'date_inscription' => date('Y-m-d H:i:s'),
            'statut' => 'postulant',
            'numero_candidat' => $numero_candidat
        ];

        // Construction dynamique de la requête
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO candidats ($columns) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($data)) {
            $lastId = $pdo->lastInsertId();
            
            $username = $numero_candidat;
            $password = password_hash($telephone1, PASSWORD_DEFAULT);
            
            $userSql = "INSERT INTO users (username, password, role, candidat_id) VALUES (?, ?, 'candidat', ?)";
            $userStmt = $pdo->prepare($userSql);
            $userStmt->execute([$username, $password, $lastId]);
            
            $_SESSION['candidat_id'] = $lastId;
            header("Location: recapitulatif.php?id=".$lastId);
            exit();
        } else {
            throw new Exception("Échec de l'exécution de la requête");
        }
    }
} catch (PDOException $e) {
    file_put_contents('db_errors.log', date('Y-m-d H:i:s')." - ".$e->getMessage()."\n", FILE_APPEND);
    $_SESSION['error'] = "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer.";
    header("Location: formulaire.php");
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: formulaire.php");
    exit();
}
?>