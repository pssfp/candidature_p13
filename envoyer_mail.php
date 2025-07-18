<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'dompdf/vendor/autoload.php'; // Chemin vers l'autoload de PHPMailer

// Récupérer les données du candidat depuis la base de données
$pdo = new PDO('mysql:host=localhost;dbname=pssfp_candidatures', 'root', '');
$candidat_id = $lastId; // Utilise la variable définie dans submit.php
$stmt = $pdo->prepare("SELECT * FROM candidats WHERE id = ?");
$stmt->execute([$candidat_id]);
$candidat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$candidat) {
    die("Candidat non trouvé");
}

// Configuration de l'email
$mail = new PHPMailer(true);

try {
    // Paramètres du serveur SMTP (adaptez à votre configuration)
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Votre serveur SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'votre@email.com'; // Votre email
    $mail->Password = 'votre_mot_de_passe'; // Votre mot de passe
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinataires
    $mail->setFrom('no-reply@pssfp.net', 'PSSFP - Plateforme de candidature');
    $mail->addAddress($candidat['email']); // Email du candidat
    $mail->addBCC('admin@pssfp.net'); // Copie cachée pour vous

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = 'Confirmation de votre candidature PSSFP';
    
    $mail->Body = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background-color: #6a0dad; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 0.8em; }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Confirmation de candidature</h1>
        </div>
        <div class="content">
            <p>Bonjour ' . $candidat['prenom'] . ' ' . $candidat['nom'] . ',</p>
            <p>Nous avons bien reçu votre candidature pour le Master Professionnel en Finances Publiques (13ème promotion).</p>
            <p><strong>Numéro de candidat :</strong> P13025-' . $candidat['id'] . '</p>
            <p><strong>Spécialité choisie :</strong> ' . $candidat['specialite'] . '</p>
            
            <p>Vous pouvez à tout moment consulter et modifier votre dossier en vous connectant à notre plateforme.</p>
            
            <p>Pour toute question, n\'hésitez pas à nous contacter à l\'adresse info@pssfp.net ou au (+237) 694 17 61 92.</p>
            
            <p>Cordialement,</p>
            <p>L\'équipe du PSSFP</p>
        </div>
        <div class="footer">
            &copy; ' . date('Y') . ' Programme Supérieur de Spécialisation en Finances Publiques
        </div>
    </body>
    </html>
    ';
    
    $mail->AltBody = "Bonjour " . $candidat['prenom'] . " " . $candidat['nom'] . ",\n\n"
                   . "Nous avons bien reçu votre candidature pour le Master Professionnel en Finances Publiques (13ème promotion).\n\n"
                   . "Numéro de candidat : P13025-" . $candidat['id'] . "\n"
                   . "Spécialité choisie : " . $candidat['specialite'] . "\n\n"
                   . "Vous pouvez à tout moment consulter et modifier votre dossier en vous connectant à notre plateforme.\n\n"
                   . "Pour toute question, n'hésitez pas à nous contacter à l'adresse info@pssfp.net ou au (+237) 694 17 61 92.\n\n"
                   . "Cordialement,\n"
                   . "L'équipe du PSSFP";

    $mail->send();
    $_SESSION['email_sent'] = true;
} catch (Exception $e) {
    $_SESSION['email_error'] = "L'email de confirmation n'a pas pu être envoyé. Erreur: " . $mail->ErrorInfo;
}
?>