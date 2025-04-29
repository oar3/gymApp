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
            background: linear-gradient(to right, #4F46E5, #1d4ed8);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            display: block;
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
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .reset-url {
            word-break: break-all;
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <!-- Dumbbell icon embedded inline -->
        <svg class="logo" fill="#FFFFFF" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 485.535 485.535" xml:space="preserve">
            <g>
                <g id="_x35__13_">
                    <g>
                        <path d="M55.465,123.228c-15.547,0-28.159,12.608-28.159,28.161v56.673C11.653,211.908,0,225.928,0,242.765
                            c0,16.842,11.652,30.861,27.306,34.707v56.666c0,15.555,12.612,28.16,28.159,28.16c15.546,0,28.16-12.605,28.16-28.16V151.389
                            C83.625,135.837,71.011,123.228,55.465,123.228z"/>
                        <path d="M334.498,65.278c-23.092,0-41.811,18.719-41.811,41.812v93.864h-12.801h-60.585h-19.625l-6.827-0.163V107.09
                            c0-23.092-18.72-41.812-41.813-41.812c-23.091,0-41.812,18.719-41.812,41.812v271.355c0,23.093,18.721,41.812,41.812,41.812
                            c23.094,0,41.813-18.719,41.813-41.812v-93.653c0,0,4.501-0.211,6.827-0.211h19.625h60.585h12.801v93.864
                            c0,23.093,18.719,41.812,41.811,41.812c23.094,0,41.812-18.719,41.812-41.812V107.089
                            C376.311,83.998,357.592,65.278,334.498,65.278z"/>
                        <path d="M458.229,208.062v-56.673c0-15.552-12.613-28.161-28.158-28.161c-15.547,0-28.16,12.608-28.16,28.161v182.749
                            c0,15.555,12.613,28.16,28.16,28.16c15.545,0,28.158-12.605,28.158-28.16v-56.666c15.654-3.846,27.307-17.865,27.307-34.707
                            C485.535,225.927,473.883,211.908,458.229,208.062z"/>
                    </g>
                </g>
            </g>
        </svg>
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

        <p>Regards,<br>The Gym App Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Gym App. All rights reserved.</p>
        <p>
            <a href="{{ url('/terms') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Terms</a> |
            <a href="{{ url('/privacy') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Privacy</a> |
            <a href="{{ url('/contact') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Contact</a>
        </p>
    </div>
</div>
</body>
</html>
