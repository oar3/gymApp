<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Gym App</title>
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
        .feature-box {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .feature-title {
            font-weight: bold;
            margin-top: 0;
            color: #4F46E5;
        }
        .welcome-banner {
            text-align: center;
            padding-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            vertical-align: top;
            padding: 10px;
        }
        .icon-circle {
            background-color: #4F46E5;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <!-- Using $message->embed for the logo image -->
        <img src="{{$message->embed('/public/images/dumbbell.png'}}" alt="Gym App Logo" class="logo">
        <p></p>
        <h1>Welcome to Gym App</h1>
    </div>

    <div class="content">
        <div class="welcome-banner">
            <h2>Hello, {{$user->first_name}}!</h2>
            <p>Thank you for joining our fitness community. Your fitness journey starts now!</p>

            <p style="text-align: center;">
                <a href="{{ url('/workouts/create') }}" class="button">Create Your First Workout</a>
            </p>
        </div>

        <table>
            <tr>
                <td>
                    <div class="feature-box">
                        <div class="icon-circle">
                            <!-- Using $message->embed for feature icons -->
{{--                            <img src="{{ $message->embed(public_path('images/track-icon.png')) }}" alt="Track Icon" width="20" height="20">--}}
                        </div>
                        <h3 class="feature-title">Track Your Progress</h3>
                        <p>Log workouts and monitor your strength improvements over time.</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="feature-box">
                        <div class="icon-circle">
{{--                            <img src="{{ $message->embed(public_path('images/explore-icon.png')) }}" alt="Explore Icon" width="20" height="20">--}}
                        </div>
                        <h3 class="feature-title">Explore Exercises</h3>
                        <p>Discover new exercises or create custom ones specific to your routine.</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="feature-box">
                        <div class="icon-circle">
{{--                            <img src="{{ $message->embed(public_path('images/consistency-icon.png')) }}" alt="Consistency Icon" width="20" height="20">--}}
                        </div>
                        <h3 class="feature-title">Stay Consistent</h3>
                        <p>Build the habit by regularly logging your workouts.</p>
                    </div>
                </td>
            </tr>
        </table>

        <p>Ready to get started? Here's what you can do next:</p>
        <ul>
            <li>Browse our <a href="{{ url('/exercises') }}" style="color: #4F46E5; text-decoration: none;">exercise library</a></li>
            <li>Set up your <a href="{{ url('/profile') }}" style="color: #4F46E5; text-decoration: none;">profile</a></li>
            <li>Create your first <a href="{{ url('/workouts/create') }}" style="color: #4F46E5; text-decoration: none;">workout plan</a></li>
        </ul>

        <p>If you have any questions, feel free to reach out to our support team.</p>

        <p>Happy training,<br>The Gym App Team</p>
    </div>

    <div class="footer">
        <!-- Using $message->embed for footer logo -->
{{--        <img src="{{ $message->embed(public_path('images/small-logo.png')) }}" alt="Small Logo" width="30" height="30">--}}
        <p>&copy; {{ date('Y') }} Gym App. All rights reserved.</p>
        <p>
            <a href="{{ url('/terms') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Terms</a> |
            <a href="{{ url('/privacy') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Privacy</a> |
            <a href="{{ url('/contact') }}" style="color: #666; text-decoration: none; margin: 0 5px;">Contact</a>
        </p>
    </div>
</div>
<p>Dear {{$user->first_name}}</p>
</body>
</html>
