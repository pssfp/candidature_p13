<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// la librairie pour le QR Code
require_once 'phpqrcode/qrlib.php';

// Connexion DB
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$candidat_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM candidats WHERE id = ?");
$stmt->execute([$candidat_id]);
$candidat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$candidat)
    die("Candidat non trouvé");

function generateHTML($candidat, $filigrane)
{
    $date = date('d/m/Y à H:i');

    $qrContent = "Candidat PSSFP\n";
    $qrContent .= "N°: P13025-" . $candidat['id'] . "\n";
    $qrContent .= "Nom: " . $candidat['prenom'] . " " . $candidat['nom'] . "\n";
    $qrContent .= "Email: " . $candidat['email'] . "\n";
    $qrContent .= "Date: " . $date;
    $qrContent = "http://localhost/candidature_P13/" . $candidat['id'];


    // Générer le QR Code
    $qrPath = 'temp/qrcode_' . $candidat['id'] . '.png';
    QRcode::png($qrContent, $qrPath, QR_ECLEVEL_L, 4, 2);
    $qrData = base64_encode(file_get_contents($qrPath));
    unlink($qrPath);

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Fiche du candidat</title>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
            }

            .filigrane {
                position: absolute;
                top: 40%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-30deg);
                font-size: 50px;
                font-weight: 600;
                color: rgba(158, 158, 158, 0.2);
                z-index: 0;
            }

            .header {
                text-align: center;
                border-bottom: 2px solid #6a0dad;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            header h1 {
                color: #6a0dad;
                font-size: 22px;
            }

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

            .qr-box {
                float: right;
                width: 100px;
                height: 100px;
                margin-left: 10px;
                margin-top: 10px;
            }

            .section {
                margin-bottom: 20px;
                clear: both;
            }

            .section-title {
                background: #f4f0ff;
                border-left: 5px solid #6a0dad;
                padding: 5px 10px;
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }

            .info-row {
                margin: 4px 0;
            }

            .info-label {
                display: inline-block;
                width: 35%;
                font-weight: bold;
                vertical-align: top;
            }

            .info-value {
                display: inline-block;
                width: 60%;
            }

            .footer {
                font-size: 10px;
                text-align: center;
                color: #666;
                border-top: 1px solid #ccc;
                margin-top: 30px;
                padding-top: 10px;
            }

            .page-break {
                page-break-after: always;
            }

            .qr-container {
                position: absolute;
                bottom: 80px;
                right: 0px;
                text-align: center;
                font-size: 8px;
            }
        </style>
    </head>

    <body>

        <div class="filigrane"><?= $filigrane ?></div>

        <div class="header">
            <table width="100%" style="margin-bottom: 10px; border-collapse: collapse;">
                <tr>
                    <td style="width: 35%; font-size: 8px; text-align: center; vertical-align: middle; line-height: 1.1;">
                        REPUBLIQUE DU CAMEROUN<br>
                        Paix - Travail - Patrie<br>
                        --------------<br>
                        MINISTÈRE DES FINANCES<br>
                        --------------<br>
                        SECRÉTARIAT GÉNÉRAL<br>
                        --------------<br>
                        PROGRAMME SUPÉRIEUR DE SPÉCIALISATION EN FINANCES PUBLIQUES<br>
                        --------------
                    </td>
                    <td style="width: 30%; text-align: center; vertical-align: middle;">
                        <img src="logo.png" alt="Logo" height="50">
                    </td>
                    <td style="width: 35%; font-size: 8px; text-align: center; vertical-align: middle; line-height: 1.1;">
                        REPUBLIC OF CAMEROON<br>
                        Peace - Work - Fatherland<br>
                        --------------<br>
                        MINISTRY OF FINANCE<br>
                        ----------------<br>
                        GENERAL SECRETARIAT<br>
                        --------------<br>
                        ADVANCED PROGRAM OF SPECIALISATION IN PUBLIC FINANCE<br>
                        --------------
                    </td>
                </tr>
            </table>



            <h1>Fiche récapitulative de candidature</h1>
            <p>Généré le <?= $date ?> - candidat N° candidat: P13025-<?= $candidat['id'] ?></p>
        </div>

        <div class="qr-container">
            <img src="data:image/png;base64,<?= $qrData ?>" style="border: 20px solid white" alt="QR Code" class="qr-box">
            <div>Scannez pour vérifier</div>
        </div>

        <div class="section">
            <div class="section-title">Spécialité</div>
            <div class="info-row"><span class="info-label">Type d'étude :</span><span
                    class="info-value"><?= $candidat['type_etude'] ?></span></div>
            <div class="info-row"><span class="info-label">Spécialité :</span><span
                    class="info-value"><?= $candidat['specialite'] ?></div>
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
            <div class="info-row"><span class="info-label">Nom complet :</span><span
                    class="info-value"><?= $candidat['civilite'] . ' ' . $candidat['prenom'] . ' ' . $candidat['nom'] ?></span>
            </div>
            <div class="info-row"><span class="info-label">Épouse :</span><span
                    class="info-value"><?= $candidat['epouse'] ?></span></div>
            <div class="info-row"><span class="info-label">Date & lieu de naissance :</span><span
                    class="info-value"><?= $candidat['date_naissance'] . ' à ' . $candidat['lieu_naissance'] ?></span></div>
            <div class="info-row"><span class="info-label">Nationalité :</span><span
                    class="info-value"><?= $candidat['nationalite'] ?></span></div>
            <div class="info-row"><span class="info-label">Statut matrimonial :</span><span
                    class="info-value"><?= $candidat['statut_matrimonial'] ?> (<?= $candidat['nb_enfants'] ?>
                    enfants)</span></div>
        </div>

        <div class="section">
            <div class="section-title">Coordonnées</div>
            <div class="info-row"><span class="info-label">Téléphones :</span><span
                    class="info-value"><?= $candidat['telephone1'] ?> / <?= $candidat['telephone2'] ?></span></div>
            <div class="info-row"><span class="info-label">Email :</span><span
                    class="info-value"><?= $candidat['email'] ?></span></div>
            <div class="info-row"><span class="info-label">Adresse :</span><span
                    class="info-value"><?= $candidat['adresse'] . ' - ' . $candidat['ville_residence'] . ', ' . $candidat['pays_residence'] ?></span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Parcours académique</div>
            <div class="info-row"><span class="info-label">Diplôme obtenu :</span><span
                    class="info-value"><?= $candidat['diplome_obtenu'] ?></span></div>
            <div class="info-row"><span class="info-label">Spécialité :</span><span
                    class="info-value"><?= $candidat['specialite_diplome'] ?></span></div>
            <div class="info-row"><span class="info-label">Année :</span><span
                    class="info-value"><?= $candidat['annee_diplome'] ?></span></div>
            <div class="info-row"><span class="info-label">Institu d'obtention :</span><span
                    class="info-value"><?= $candidat['institut'] ?></span></div>
        </div>

        <div class="section">
            <div class="section-title">Situation professionnelle</div>
            <div class="info-row"><span class="info-label">Statut :</span><span
                    class="info-value"><?= $candidat['statut_actuel'] ?></span></div>
            <div class="info-row"><span class="info-label">Employeur :</span><span
                    class="info-value"><?= $candidat['employeur'] . ' (' . $candidat['tel_employeur'] . ')' ?></span></div>

        </div>

        <div class="section">
            <div class="section-title">Autres informations</div>
            <div class="info-row"><span class="info-label">Moyen de connaissance :</span><span
                    class="info-value"><?= $candidat['moyen_connaissance'] ?></span></div>
        </div>

        <div class="footer">
            Plateforme PSSFP – © <?= date('Y') ?> – Tous droits réservés
        </div>

    </body>

    </html>
    <?php
    return ob_get_clean();
}

$html_candidat = generateHTML($candidat, "COPIE CANDIDAT");
$html_admin = generateHTML($candidat, "COPIE ADMINISTRATION");

// pour me permettre de faire le saut de page
$html_complet = $html_candidat . '<div class="page-break"></div>' . $html_admin;

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html_complet);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
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
