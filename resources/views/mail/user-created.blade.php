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
        <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="800px" height="800px" viewBox="0 0 485.535 485.535"
             xml:space="preserve">
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
