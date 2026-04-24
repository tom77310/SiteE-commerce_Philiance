<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

function ctlEnvoyerContact() {

    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lemairetomtom@gmail.com'; // gmail de destination
        $mail->Password = 'wdma ziui jyfj ambi'; // mdp app google
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Expéditeur
        $mail->setFrom('lemairetomtom@gmail.com', 'Site E-commerce');

        // Destinataire 
        $mail->addAddress('lemairetomtom@gmail.com');

        //Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message de contact';

        $mail->Body = "
            <h3>Nouveau message</h3>
            <p><strong>Nom :</strong> $nom</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $mail->send();

        $mail->addReplyTo($email, $nom); // Pour repondre au mail 
        
        header("Location: index.php?action=formcontact&success=1");

    } catch (Exception $ex) {
        header("Location: index.php?action=formcontact&error=1");
    }
    exit();
}







?>