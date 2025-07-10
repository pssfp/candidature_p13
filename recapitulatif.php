<?php
session_start();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// 1. CONNEXION À LA BASE DE DONNÉES
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. RÉCUPÉRATION DU CANDIDAT
$candidat_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM candidats WHERE id = ?");
$stmt->execute([$candidat_id]);
$candidat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$candidat) {
    die("Candidat non trouvé");
}

// 3. TRAITEMENT DES MODIFICATIONS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modifier'])) {
        // Construction dynamique des données à mettre à jour
        $data = ['id' => $candidat_id];
        $updateFields = [];

        // Liste de tous les champs possibles
        $allFields = [
            'civilite',
            'nom',
            'prenom',
            'epouse',
            'date_naissance',
            'lieu_naissance',
            'region',
            'departement',
            'nationalite',
            'statut_matrimonial',
            'nb_enfants',
            'pays_origine',
            'pays_residence',
            'ville_residence',
            'adresse',
            'telephone1',
            'telephone2',
            'email',
            'specialite',
            'type_etude',
            'diplome_obtenu',
            'specialite_diplome',
            'annee_diplome',
            'statut_actuel',
            'employeur',
            'tel_employeur',
            'institut',
            'adresse_employeur2',
            'email_admin',
            'moyen_connaissance',
            'engagement_nom',
            'mode_paiement'
        ];

        foreach ($allFields as $field) {
            if (isset($_POST[$field])) {
                $data[$field] = $_POST[$field];
                $updateFields[] = "$field = :$field";
            }
        }

        // Construction de la requête SQL
        $sql = "UPDATE candidats SET " . implode(', ', $updateFields) . " WHERE id = :id";

        try {
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($data)) {
                $_SESSION['success'] = "Modifications enregistrées avec succès!";
                // Actualiser les données
                header("Location: recapitulatif.php?id=" . $candidat_id);
                exit();
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur DB: " . $e->getMessage();
        }
    } elseif (isset($_POST['valider'])) {
        // [Code existant pour la génération PDF...]
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de candidature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            background-color: #6a0dad;
            position: ;
            color: white;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        header img {
            height: 60px;
        }

        header .title {
            flex: 1;
            text-align: center;
        }

        .fiche-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            color: #6a0dad;
            border-bottom: 2px solid #6a0dad;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .form-section {
            position: relative;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 25px;
            margin-bottom: 30px;
            background-color: #fff;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .info-value {
            padding: 8px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            min-height: 38px;
        }

        .info-value:hover {
            background-color: #f8f9fa;
        }

        .edit-field {
            display: none;
            margin-bottom: 15px;
        }

        .editing .info-value {
            display: none;
        }

        .editing .edit-field {
            display: block;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #fff;
            border: none;
            padding-left: 0;
        }

        .field-container .info-value {
            display: block;
            padding: 8px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            min-height: 38px;
        }

        .field-container .edit-field {
            display: none;
            margin-bottom: 15px;
        }

        /* Quand on est en mode édition */
        .field-container.editing .info-value {
            display: none;
        }

        .field-container.editing .edit-field {
            display: block;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.png" alt="Logo PSSFP">
        <div class="title">
            <h1 class="mb-0">Appel à candidature</h1>
            <p class="mb-0">13ème promotion Master en Finances Publiques</p>
            <p class="mb-0">Année académique: 2025 - 2026</p>
        </div>
    </header>
    <div class="container py-4">
        <div class="fiche-container">
            <div class="text-center mb-5">
                <h1 class="text-purple"><i class="bi bi-file-earmark-person"></i> Récapitulatif de candidature</h1>
                <p class="lead">Vérifiez et modifiez vos informations avant validation finale</p>
                <div class="badge bg text-success fs-6">
                    <i class="bi bi-person-badge"></i> N° candidat: <?= $candidat['numero_candidat'] ?>
                </div>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form method="post" action="telecharger_pdf.php?id=<?= $candidat['id'] ?>" id="candidatureForm">
                <!-- Section 1: Spécialité -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-bookmark-star"></i> Spécialité</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Spécialité</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['specialite']) ?>
                                </div>
                                <select class="form-select edit-field" name="specialite"
                                    onblur="disableFieldEdit(this)">
                                    <option value="Finances Publiques" <?= $candidat['specialite'] == 'Finances Publiques' ? 'selected' : '' ?>>Finances Publiques</option>
                                    <option value="Comptabilité Publique" <?= $candidat['specialite'] == 'Comptabilité Publique' ? 'selected' : '' ?>>Comptabilité Publique</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Type d'étude</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['type_etude']) ?>
                                </div>
                                <div class="edit-field">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_etude"
                                            value="Présentiel" id="type_presentiel"
                                            <?= $candidat['type_etude'] == 'Présentiel' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="type_presentiel">Présentiel</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_etude"
                                            value="Distanciel" id="type_distanciel"
                                            <?= $candidat['type_etude'] == 'Distanciel' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="type_distanciel">Distanciel</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Informations personnelles -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-person-vcard"></i> Informations personnelles</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Civilité</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['civilite']) ?>
                                </div>
                                <select class="form-select edit-field" name="civilite" onblur="disableFieldEdit(this)">
                                    <option value="M." <?= $candidat['civilite'] == 'M.' ? 'selected' : '' ?>>M.</option>
                                    <option value="Mme" <?= $candidat['civilite'] == 'Mme' ? 'selected' : '' ?>>Mme
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Nom</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['nom']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="nom"
                                    value="<?= htmlspecialchars($candidat['nom']) ?>" onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Prénom</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['prenom']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="prenom"
                                    value="<?= htmlspecialchars($candidat['prenom']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Nom d'épouse</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['epouse']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="epouse"
                                    value="<?= htmlspecialchars($candidat['epouse']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Date de naissance</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['date_naissance']) ?>
                                </div>
                                <input type="date" class="form-control edit-field" name="date_naissance"
                                    value="<?= htmlspecialchars($candidat['date_naissance']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Lieu de naissance</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['lieu_naissance']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="lieu_naissance"
                                    value="<?= htmlspecialchars($candidat['lieu_naissance']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Région</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['region']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="region"
                                    value="<?= htmlspecialchars($candidat['region']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Département</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['departement']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="departement"
                                    value="<?= htmlspecialchars($candidat['departement']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Nationalité</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['nationalite']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="nationalite"
                                    value="<?= htmlspecialchars($candidat['nationalite']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Statut matrimonial</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['statut_matrimonial']) ?>
                                </div>
                                <select class="form-select edit-field" name="statut_matrimonial"
                                    onblur="disableFieldEdit(this)">
                                    <option value="Célibataire" <?= $candidat['statut_matrimonial'] == 'Célibataire' ? 'selected' : '' ?>>Célibataire</option>
                                    <option value="Marié(e)" <?= $candidat['statut_matrimonial'] == 'Marié(e)' ? 'selected' : '' ?>>Marié(e)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Nombre d'enfants à charge</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['nb_enfants']) ?>
                                </div>
                                <input type="number" class="form-control edit-field" name="nb_enfants"
                                    value="<?= htmlspecialchars($candidat['nb_enfants']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Coordonnées -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-geo-alt"></i> Coordonnées</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Pays d'origine</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['pays_origine']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="pays_origine"
                                    value="<?= htmlspecialchars($candidat['pays_origine']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Pays de résidence</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['pays_residence']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="pays_residence"
                                    value="<?= htmlspecialchars($candidat['pays_residence']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Ville de résidence</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['ville_residence']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="ville_residence"
                                    value="<?= htmlspecialchars($candidat['ville_residence']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Adresse</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['adresse']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="adresse"
                                    value="<?= htmlspecialchars($candidat['adresse']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4 field-container">
                                <div class="info-label">Téléphone (WhatsApp)</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['telephone1']) ?>
                                </div>
                                <input type="tel" class="form-control edit-field" name="telephone1"
                                    value="<?= htmlspecialchars($candidat['telephone1']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4 field-container">
                                <div class="info-label">Autre téléphone</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['telephone2']) ?>
                                </div>
                                <input type="tel" class="form-control edit-field" name="telephone2"
                                    value="<?= htmlspecialchars($candidat['telephone2']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Email personnel</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['email']) ?>
                                </div>
                                <input type="email" class="form-control edit-field" name="email"
                                    value="<?= htmlspecialchars($candidat['email']) ?>" onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Confirmation email</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['email']) ?>
                                </div>
                                <input type="email" class="form-control edit-field" name="email_confirmation"
                                    value="<?= htmlspecialchars($candidat['email']) ?>" onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Cursus académique -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-mortarboard"></i> Cursus académique</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Dernier diplôme obtenu</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['diplome_obtenu']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="diplome_obtenu"
                                    value="<?= htmlspecialchars($candidat['diplome_obtenu']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">institut</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['institut']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="institut"
                                    value="<?= htmlspecialchars($candidat['institut']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Spécialité du diplôme</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['specialite_diplome']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="specialite_diplome"
                                    value="<?= htmlspecialchars($candidat['specialite_diplome']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Année d'obtention</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['annee_diplome']) ?>
                                </div>
                                <input type="number" class="form-control edit-field" name="annee_diplome"
                                    value="<?= htmlspecialchars($candidat['annee_diplome']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Coordonnées professionnelles -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-briefcase"></i> Coordonnées professionnelles</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Statut actuel</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['statut_actuel']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="statut_actuel"
                                    value="<?= htmlspecialchars($candidat['statut_actuel']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Employeur</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['employeur']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="employeur"
                                    value="<?= htmlspecialchars($candidat['employeur']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4 field-container">
                                <div class="info-label">Téléphone employeur</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['tel_employeur']) ?>
                                </div>
                                <input type="tel" class="form-control edit-field" name="tel_employeur"
                                    value="<?= htmlspecialchars($candidat['tel_employeur']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Adresse employeur</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['adresse_employeur2']) ?>
                                </div>
                                <input type="text" class="form-control edit-field" name="adresse_employeur2"
                                    value="<?= htmlspecialchars($candidat['adresse_employeur2']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 field-container">
                                <div class="info-label">Email administratif</div>
                                <div class="info-value" onclick="enableFieldEdit(this)">
                                    <?= htmlspecialchars($candidat['email_admin']) ?>
                                </div>
                                <input type="email" class="form-control edit-field" name="email_admin"
                                    value="<?= htmlspecialchars($candidat['email_admin']) ?>"
                                    onblur="disableFieldEdit(this)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Paiement -->
                <div class="form-section">
                    <h2 class="section-title"><i class="bi bi-credit-card"></i> Paiement des frais de candidature</h2>

                    <div class="mb-4">
                        <div class="info-label">Mode de paiement</div>
                        <div class="info-value"><?= htmlspecialchars($candidat['mode_paiement']) ?></div>
                    </div>

                    <?php if ($candidat['mode_paiement'] == 'OM/MoMo'): ?>
                        <div class="alert alert-info">
                            <p>Veuillez effectuer un paiement de <strong>10 000 FCFA</strong> via Orange Money ou MoMo au
                                numéro suivant : <strong>699 99 99 99</strong></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <p>Le paiement en espèces s'effectuera sur place au moment du dépôt physique de votre dossier.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Boutons de validation -->
                <div class="text-center mt-5">
                    <button type="submit" name="valider" class="btn btn-success btn-lg me-3">
                        Valider et télécharger
                    </button>
                    <button type="submit" name="modifier" class="btn btn-primary btn-lg">
                        Enregistrer modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer l'édition d'un champ au clic
        function enableFieldEdit(element) {
            const container = element.closest('.field-container');
            container.classList.add('editing');

            // Focus sur le premier champ éditable
            const input = container.querySelector('.edit-field');
            if (input) {
                if (input.tagName === 'INPUT' || input.tagName === 'SELECT') {
                    input.focus();
                } else {
                    // Pour les radios, focus sur le premier
                    const firstInput = input.querySelector('input');
                    if (firstInput) firstInput.focus();
                }
            }
        }

        // Désactiver l'édition quand on quitte le champ
        function disableFieldEdit(input) {
            const container = input.closest('.field-container');
            container.classList.remove('editing');

            // Mettre à jour la valeur affichée
            const valueDisplay = container.querySelector('.info-value');
            if (input.tagName === 'SELECT') {
                valueDisplay.textContent = input.options[input.selectedIndex].text;
            } else if (input.tagName === 'INPUT' && input.type === 'radio') {
                const selectedRadio = container.querySelector('input[name="' + input.name + '"]:checked');
                if (selectedRadio) {
                    valueDisplay.textContent = selectedRadio.nextElementSibling.textContent;
                }
            } else if (input.value) {
                valueDisplay.textContent = input.value;
            }
        }

        // Pour les selects, on gère le changement de valeur
        document.querySelectorAll('select.edit-field').forEach(select => {
            select.addEventListener('change', function () {
                disableFieldEdit(this);
            });
        });

        // Pour les radios, on gère le changement
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function () {
                disableFieldEdit(this);
            });
        });

        // Validation avant soumission
        document.getElementById('candidatureForm').addEventListener('submit', function (e) {
            if (document.activeElement.name === 'valider') {
                if (!confirm("Confirmez-vous la validation définitive de votre candidature ?")) {
                    e.preventDefault();
                }
            } else if (document.activeElement.name === 'modifier') {
                if (!confirm("Enregistrer les modifications ?")) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>

</html>