import smtplib
import pandas as pd
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

def send_email(to_email, username, email, firstname):
    sender_email = "ictsupport@ouk.ac.ke"  # Update this with your sender email
    sender_password = "fndhynruhnnbmvlg"  # Update this with your sender password
    subject = "Your OUK Login Credentials"
    
    html_content = f"""
    <html>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
            <div style="text-align: center;">
                <img src="https://somasold.ouk.ac.ke/ouk_logo.png" alt="OUK Logo" width="150px" style="margin-bottom: 20px;">
                <h2 style="color: #037b90;">Welcome to Open University of Kenya</h2>
            </div>
            <p style="font-size: 16px; color: #333;">Dear {firstname},</p>
            <p style="font-size: 16px; color: #555;">your login credentials are as follows:</p>
            <div style="background: #eef9ff; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                <h3 style="color: #ff7f50;">Login for Gmail</h3>
                <p><strong>Email:</strong> {email}</p>
                <p><strong>Password:</strong> <span style="background: #ffefdb; padding: 5px; border-radius: 4px;">Karibu+OUK!</span></p>
            </div>
            <div style="background: #eef9ff; padding: 15px; border-radius: 8px;">
                <h3 style="color: #ff7f50;">Login to <a href="https://somas.ouk.ac.ke" style="color: #037b90; text-decoration: none;">somas.ouk.ac.ke</a></h3>
                <p><strong>Username:</strong> {username}</p>
                <p><strong>Password:</strong> <span style="background: #ffefdb; padding: 5px; border-radius: 4px;">Karibu+OUK!</span></p>
            </div>
            <p style="font-size: 16px; color: #555; margin-top: 20px;">Best regards,</p>
            <p style="font-size: 16px; color: #037b90;"><strong>Open University of Kenya</strong></p>
        </div>
    </body>
    </html>
    """
    
    message = MIMEMultipart()
    message['From'] = sender_email
    message['To'] = to_email
    message['Subject'] = subject
    message.attach(MIMEText(html_content, 'html'))
    
    try:
        server = smtplib.SMTP_SSL('smtp.gmail.com', 465)  # Using SSL for security
        server.login(sender_email, sender_password)
        server.sendmail(sender_email, to_email, message.as_string())
        server.quit()
        print(f"Email sent successfully to {to_email}")
    except Exception as e:
        print(f"Failed to send email to {to_email}: {e}")

# Read CSV file
csv_file = "skies.csv"
df = pd.read_csv(csv_file)

# Iterate over CSV rows
for index, row in df.iterrows():
    send_email(row['sendmail'], row['username'], row['email'], row['firstname'])
