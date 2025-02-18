<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email with Attachment</title>
</head>
<body>
    <h2>Send Email</h2>
    <form action="send_email.php" method="POST" enctype="multipart/form-data">
        <label for="to">Recipient Email:</label>
        <input type="email" name="to" required><br><br>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" required><br><br>

        <label for="message">Message:</label><br>
        <textarea name="message" rows="5" cols="50" required></textarea><br><br>

        <label for="attachment">Attach a File:</label>
        <input type="file" name="attachment"><br><br>

        <button type="submit" name="send">Send Email</button>
    </form>
</body>
</html>
