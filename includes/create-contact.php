<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $subject = isset($_POST['subject']) ? trim($_POST['subject']) : null;
        $message = isset($_POST['message']) ? trim($_POST['message']) : null;
        if (!empty($full_name) || !empty($email) || !empty($subject) || !empty($message)) {
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = $smtpHost;
                $mail->SMTPAuth = true;
                $mail->Username = $smtpUsername;
                $mail->Password = $smtpPassword;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = $smtpPort;
    
                // Recipients
                $mail->setFrom($hostEmail, $hostName);
                $mail->addAddress($email, $full_name);
                $mail->isHTML(true);
                $mail->Subject = 'Message Received';
                $mail->Body    = "Thank  you for contacting King's Glory Christian Fellowship, We will reply you shortly";
                $mail->AltBody = 'Message: ' . $message;
                $mail->send();
                
                include './includes/contact.php';
                $contactModel = new Contact($db);
                $contactModel->create($full_name, $email, $subject, $message);
                header('Location: ./success.html');
            } catch (Exception $e) {
                header('Location: ./error_page.html');
            }
        }
    }
?>
