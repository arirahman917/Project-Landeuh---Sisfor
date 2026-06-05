<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { background-color: #ffffff; padding: 30px; border-radius: 12px; max-w-lg: 500px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 20px; }
        .button { display: inline-block; padding: 12px 24px; background-color: #2f4f4f; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Permintaan Reset Password</h2>
        </div>
        <p>Halo,</p>
        <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda di Landeuh Sisfor.</p>
        <div style="text-align: center;">
            <a href="{{ $resetLink }}" class="button">Reset Password</a>
        </div>
        <p style="margin-top: 20px;">Tautan reset password ini akan kedaluwarsa dalam 60 menit.</p>
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Landeuh Village Riverside. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
