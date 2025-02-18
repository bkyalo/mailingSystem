<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = nl2br($_POST['message']); // Preserve new lines

    // Validate email format
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        die("<p style='color:red;'>Invalid email format. Please enter a valid email.</p>");
    }

    // Email HTML Template
    $emailTemplate = file_get_contents("email_template.html");
    $emailContent = str_replace("{{message}}", $message, $emailTemplate);

    $mail = new PHPMailer(true);

    try {
        // Enable SMTP Debugging (Uncomment if needed)
        // $mail->SMTPDebug = 2; // 2 = detailed debugging, 0 = no debugging in production
        // $mail->Debugoutput = 'html';

        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bentito@ouk.ac.ke'; // Change to your email
        $mail->Password   = 'tntwhgxjwfwwufqh'; // Use App Password, NOT actual password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender & Recipient
        $mail->setFrom('bentito@ouk.ac.ke', 'Ben Tito'); // Your email and name
        $mail->addAddress($to);

        // Check for attachments
        if (!empty($_FILES['attachment']['name'])) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileName = $_FILES['attachment']['name'];
            $fileSize = $_FILES['attachment']['size'];
            $fileType = $_FILES['attachment']['type'];
            $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'text/plain'];

            // Validate file type
            if (!in_array($fileType, $allowedTypes)) {
                die("<p style='color:red;'>Invalid file type! Allowed: PDF, JPG, PNG, TXT.</p>");
            }

            // Validate file size (Max: 5MB)
            if ($fileSize > 5 * 1024 * 1024) {
                die("<p style='color:red;'>File size exceeds 5MB. Please upload a smaller file.</p>");
            }

            // Attach the file
            $mail->addAttachment($fileTmpPath, $fileName);
        }

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $emailContent;

        // Send Email
        if ($mail->send()) {
            echo "<p style='color:green;'>Email sent successfully to <b>$to</b>!</p>";
        } else {
            echo "<p style='color:red;'>Failed to send email. Error: " . $mail->ErrorInfo . "</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: {$mail->ErrorInfo}</p>";
    }
}
?>
