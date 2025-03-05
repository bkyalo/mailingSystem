<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = nl2br($_POST['message']);

    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        die("<p style='color:red;'>Invalid email format.</p>");
    }

    $emailTemplate = file_get_contents("email_template.html");
    $emailContent = str_replace("{{message}}", $message, $emailTemplate);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bentito@ouk.ac.ke';
        $mail->Password   = 'tntwhgxjwfwwufqh';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('bentito@ouk.ac.ke', 'Ben Tito');
        $mail->addAddress($to);

        if (!empty($_FILES['attachments']['name'][0])) {
            foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
                $mail->addAttachment($tmp_name, $_FILES['attachments']['name'][$key]);
            }
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $emailContent;

        if ($mail->send()) {
            echo "<p style='color:green;'>Email sent successfully to <b>$to</b>!</p>";
        } else {
            echo "<p style='color:red;'>Failed to send email.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: {$mail->ErrorInfo}</p>";
    }
}
?>
