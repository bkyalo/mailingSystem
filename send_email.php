<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = nl2br($_POST['message']); // Preserve new lines

    // Load Email HTML Template
    $emailTemplate = file_get_contents("email_template.html");
    $emailContent = str_replace("{{message}}", $message, $emailTemplate);

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bentito@ouk.ac.ke'; // Your Gmail address
        $mail->Password   = 'tntwhgxjwfwwufqh'; // Use App Password (not your actual password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('bentito@ouk.ac.ke', 'Ben Tito'); // Sender email and name
        //$mail->addAddress($to); // Recipient email
        //$mail->isHTML(true);

        // Sender & Recipient
        //$mail->setFrom('your-email@example.com', 'Your Name');
        $mail->addAddress($to);

        // Attachments (if any)
        if (!empty($_FILES['attachment']['name'])) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileName = $_FILES['attachment']['name'];
            $mail->addAttachment($fileTmpPath, $fileName);
        }

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $emailContent;

        // Send Email
        if ($mail->send()) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email.";
        }
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
