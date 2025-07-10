<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Connexion DB
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$candidat_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM candidats WHERE id = ?");
$stmt->execute([$candidat_id]);
$candidat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$candidat) die("Candidat non trouvé");

function generateHTML($candidat, $filigrane) {
    $date = date('d/m/Y à H:i');
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
    <meta charset="UTF-8">
    <title>Fiche du candidat</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .filigrane {
            position: absolute;
            top: 40%; 
            left: 50%; 
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 50px;
            font-weight : 600;
            color: rgba(158, 158, 158, 0.2);
            z-index: 0;
        
        }
        .header { text-align: center; border-bottom: 2px solid #6a0dad; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #6a0dad; font-size: 22px; }
        .photo-box { 
            float: right; 
            border: 1px solid #ccc; 
            width: 120px; 
            height: 120px; 
            margin-left: 10px; 
            text-align: center; 
            font-size: 10px;
            overflow: hidden;
        }
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .section { margin-bottom: 20px; clear: both; }
        .section-title {
            background: #f4f0ff;
            border-left: 5px solid #6a0dad;
            padding: 5px 10px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .info-row { margin: 4px 0; }
        .info-label { display: inline-block; width: 35%; font-weight: bold; vertical-align: top; }
        .info-value { display: inline-block; width: 60%; }
        .footer { font-size: 10px; text-align: center; color: #666; border-top: 1px solid #ccc; margin-top: 30px; padding-top: 10px; }
        .page-break {
            page-break-after: always;
        }
    </style>
    </head>
    <body>

    <div class="filigrane"><?= $filigrane ?></div>

    <div class="header">
        <img src="logo.png" alt="Logo" height="60">
        <h1>Fiche récapitulative de candidature</h1>
        <p>Généré le <?= $date ?> - candidat N° candidat: P13025-<?= $candidat['id'] ?></p>
    </div>
    <div class="section">
        <div class="section-title">Spécialité</div>
        <div class="info-row"><span class="info-label">Type d'étude :</span><span class="info-value"><?= $candidat['type_etude'] ?></span></div>
        <div class="info-row"><span class="info-label">Spécialité :</span><span class="info-value"><?= $candidat['specialite'] ?></div>
        </div>
    <div class="section">
        <div class="section-title">Informations personnelles</div>
        <div class="photo-box">
            <?php if (!empty($candidat['photo'])): ?>
                <img src="uploads/<?= $candidat['photo'] ?>" alt="Photo du candidat">
            <?php else: ?>
                Photo 4X4 manquante
            <?php endif; ?>
        </div>
        <div class="info-row"><span class="info-label">Nom complet :</span><span class="info-value"><?= $candidat['civilite'] . ' ' . $candidat['prenom'] . ' ' . $candidat['nom'] ?></span></div>
        <div class="info-row"><span class="info-label">Épouse :</span><span class="info-value"><?= $candidat['epouse'] ?></span></div>
        <div class="info-row"><span class="info-label">Date & lieu de naissance :</span><span class="info-value"><?= $candidat['date_naissance'] . ' à ' . $candidat['lieu_naissance'] ?></span></div>
        <div class="info-row"><span class="info-label">Nationalité :</span><span class="info-value"><?= $candidat['nationalite'] ?></span></div>
        <div class="info-row"><span class="info-label">Statut matrimonial :</span><span class="info-value"><?= $candidat['statut_matrimonial'] ?> (<?= $candidat['nb_enfants'] ?> enfants)</span></div>
    </div>

    <div class="section">
        <div class="section-title">Coordonnées</div>
        <div class="info-row"><span class="info-label">Téléphones :</span><span class="info-value"><?= $candidat['telephone1'] ?> / <?= $candidat['telephone2'] ?></span></div>
        <div class="info-row"><span class="info-label">Email :</span><span class="info-value"><?= $candidat['email'] ?></span></div>
        <div class="info-row"><span class="info-label">Adresse :</span><span class="info-value"><?= $candidat['adresse'] . ' - ' . $candidat['ville_residence'] . ', ' . $candidat['pays_residence'] ?></span></div>
    </div>

    <div class="section">
        <div class="section-title">Parcours académique</div>
        <div class="info-row"><span class="info-label">Diplôme obtenu :</span><span class="info-value"><?= $candidat['diplome_obtenu'] ?></span></div>
        <div class="info-row"><span class="info-label">Spécialité :</span><span class="info-value"><?= $candidat['specialite_diplome'] ?></span></div>
        <div class="info-row"><span class="info-label">Année :</span><span class="info-value"><?= $candidat['annee_diplome'] ?></span></div>
    </div>

    <div class="section">
        <div class="section-title">Situation professionnelle</div>
        <div class="info-row"><span class="info-label">Statut :</span><span class="info-value"><?= $candidat['statut_actuel'] ?></span></div>
        <div class="info-row"><span class="info-label">Employeur :</span><span class="info-value"><?= $candidat['employeur'] . ' (' . $candidat['tel_employeur'] . ')' ?></span></div>
        <div class="info-row"><span class="info-label">Institu d'obtention :</span><span class="info-value"><?= $candidat['institut'] ?></span></div>
    </div>

    <div class="section">
        <div class="section-title">Autres informations</div>
        <div class="info-row"><span class="info-label">Moyen de connaissance :</span><span class="info-value"><?= $candidat['moyen_connaissance'] ?></span></div>
        <div class="info-row"><span class="info-label">Nom engagement :</span><span class="info-value"><?= $candidat['engagement_nom'] ?></span></div>
        <div class="info-row"><span class="info-label">Mode de paiement :</span><span class="info-value"><?= $candidat['mode_paiement'] ?></span></div>
    </div>

    <div class="footer">
        Plateforme PSSFP – © <?= date('Y') ?> – Tous droits réservés
    </div>

    </body>
    </html>
    <?php
    return ob_get_clean();
}

// Générer le HTML pour les deux versions
$html_candidat = generateHTML($candidat, "COPIE CANDIDAT");
$html_admin = generateHTML($candidat, "COPIE ADMINISTRATION");

// Combiner les deux pages avec un saut de page
$html_complet = $html_candidat . '<div class="page-break"></div>' . $html_admin;

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Permet le chargement des images distantes

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_complet);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Ajouter le chemin absolu pour les images locales
$context = stream_context_create([ 
    'ssl' => [ 
        'verify_peer' => FALSE, 
        'verify_peer_name' => FALSE,
        'allow_self_signed' => TRUE
    ] 
]);
$dompdf->setHttpContext($context);

$dompdf->stream("fiche_candidat.pdf", ["Attachment" => true]);
?>