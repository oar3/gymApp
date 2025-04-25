<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px;
        }
        .content {
            padding: 0 20px;
        }
        .button {
            display: inline-block;
            background-color: #4F46E5;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .reset-url {
            word-break: break-all;
            margin-top: 20px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Reset Your Password</h1>
    </div>

    <div class="content">
        <p>Hello,</p>

        <p>You are receiving this email because we received a password reset request for your account.</p>

        <p style="text-align: center;">
            <a href="{{ $url }}" class="button">Reset Password</a>
        </p>

        <p>This password reset link will expire in 60 minutes.</p>

        <p>If you did not request a password reset, no further action is required.</p>

        <div class="reset-url">
            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
            <p>{{ $url }}</p>
        </div>

        <p>Regards,</p>
    </div>

    <div class="footer">
    </div>
</div>
</body>
</html>
