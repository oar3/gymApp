<!DOCTYPE html>
<html>
<head>
    <title>Basic Pusher Test</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .log { background: #000; color: #fff; padding: 10px; border-radius: 4px; height: 300px; overflow-y: auto; }
        .status { margin-top: 20px; }
        .status.connected { color: green; }
        .status.disconnected { color: red; }
        .message { background: #e0e0e0; padding: 10px; margin: 10px 0; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Basic Pusher Test</h1>

    <div class="card">
        <h2>Pusher Connection</h2>
        <div id="connection-status" class="status">Connecting...</div>
    </div>

    <div class="card">
        <h2>Event Log</h2>
        <div id="event-log" class="log"></div>
    </div>

    <div class="card">
        <h2>Messages</h2>
        <div id="messages"></div>
    </div>
</div>

<script>
    // Function to log messages to the event log
    function log(message) {
        const logElement = document.getElementById('event-log');
        const entry = document.createElement('div');
        entry.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
        logElement.appendChild(entry);
        logElement.scrollTop = logElement.scrollHeight;
        console.log(message);
    }

    // Function to show a message
    function showMessage(data) {
        const messagesElement = document.getElementById('messages');
        const message = document.createElement('div');
        message.className = 'message';
        message.textContent = JSON.stringify(data, null, 2);
        messagesElement.prepend(message);
    }

    // Set up Pusher
    const pusherKey = '{{ env("PUSHER_APP_KEY") }}';
    const pusherCluster = '{{ env("PUSHER_APP_CLUSTER") }}';

    log(`Initializing Pusher with key: ${pusherKey}, cluster: ${pusherCluster}`);

    // Enable Pusher logging
    Pusher.logToConsole = true;

    // Create a new Pusher instance
    const pusher = new Pusher(pusherKey, {
        cluster: pusherCluster,
        forceTLS: true
    });

    // Connection events
    pusher.connection.bind('connecting', () => {
        log('Connecting to Pusher...');
        document.getElementById('connection-status').textContent = 'Connecting...';
        document.getElementById('connection-status').className = 'status';
    });

    pusher.connection.bind('connected', () => {
        log('Connected to Pusher!');
        document.getElementById('connection-status').textContent = 'Connected';
        document.getElementById('connection-status').className = 'status connected';
    });

    pusher.connection.bind('disconnected', () => {
        log('Disconnected from Pusher');
        document.getElementById('connection-status').textContent = 'Disconnected';
        document.getElementById('connection-status').className = 'status disconnected';
    });

    pusher.connection.bind('error', (err) => {
        log(`Connection error: ${err.message}`);
        document.getElementById('connection-status').textContent = `Error: ${err.message}`;
        document.getElementById('connection-status').className = 'status disconnected';
    });

    // Subscribe to the workouts channel
    const channel = pusher.subscribe('workouts');
    log('Subscribed to "workouts" channel');

    // Listen for all events on the channel
    channel.bind_global((eventName, data) => {
        log(`Event received: ${eventName}`);
        log(`Data: ${JSON.stringify(data)}`);
        showMessage(data);
    });

    // Listen specifically for WorkoutRecorded event
    channel.bind('WorkoutRecorded', (data) => {
        log('WorkoutRecorded event received');
        log(`Data: ${JSON.stringify(data)}`);
        showMessage(data);
    });

    // For Laravel Events with namespaces, also try with dot prefix
    channel.bind('.WorkoutRecorded', (data) => {
        log('.WorkoutRecorded event received');
        log(`Data: ${JSON.stringify(data)}`);
        showMessage(data);
    });

    // Log subscription succeeded
    channel.bind('pusher:subscription_succeeded', () => {
        log('Successfully subscribed to workouts channel');
    });

    // Other Pusher events
    pusher.bind_global((eventName, data) => {
        if (eventName.startsWith('pusher:')) {
            log(`Pusher event: ${eventName}`);
        }
    });
</script>
</body>
</html>
