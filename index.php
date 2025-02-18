<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email with Attachment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #873036;
        }

        label {
            font-weight: bold;
            color: #008C4F;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus, textarea:focus {
            border-color: #00A4EE;
            outline: none;
        }

        button {
            width: 100%;
            background: #FE6702;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #873036;
        }

        .file-input {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00A4EE;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .file-input:hover {
            background: #008C4F;
        }

        .file-input input {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Send Email</h2>
        <form action="send_email.php" method="POST" enctype="multipart/form-data">
            <label for="to">Recipient Email:</label>
            <input type="email" name="to" placeholder="Enter recipient's email" required>

            <label for="subject">Subject:</label>
            <input type="text" name="subject" placeholder="Enter subject" required>

            <label for="message">Message:</label>
            <textarea name="message" rows="5" placeholder="Write your message..." required></textarea>

            <label class="file-input">
                Attach a File
                <input type="file" name="attachment">
            </label>

            <button type="submit" name="send">Send Email</button>
        </form>
    </div>

</body>
</html>
