<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'dompdf/vendor/autoload.php'; // Chemin vers l'autoload de PHPMailer

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
    $mail->setFrom('no-reply@votresite.com', 'Votre Plateforme');
    $mail->addAddress($candidat['email']); // Email du candidat
    $mail->addBCC('admin@votresite.com'); // Copie cachée pour vous

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = 'Votre candidature en PDF';
    $mail->Body    = 'Bonjour ' . $candidat['prenom'] . ',<br><br>'
                   . 'Veuillez trouver ci-joint le PDF de votre candidature.<br><br>'
                   . 'Cordialement,<br>L\'équipe de recrutement';
    $mail->AltBody = 'Bonjour, veuillez trouver votre PDF en pièce jointe.';

    // Pièce jointe
    $mail->addStringAttachment($pdfContent, $filename);

    $mail->send();
    $_SESSION['email_sent'] = true;
} catch (Exception $e) {
    $_SESSION['email_error'] = "Le PDF a été généré mais l'email n'a pas pu être envoyé. Erreur: " . $mail->ErrorInfo;
}
?>