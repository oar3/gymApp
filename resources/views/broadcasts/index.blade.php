<x-layout>
    <x-slot:heading>
        Workout Broadcasts
    </x-slot:heading>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                    <div class="card-header flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2" class="opacity-75"></circle>
                            <circle cx="12" cy="12" r="3" fill="currentColor"></circle>
                        </svg>
                        <h2 class="text-xl font-bold">Live Workout Feed</h2>
                    </div>

                    <div class="card-body">
                        <h3 class="text-lg mb-4 font-semibold text-amber-400">Recent Workouts</h3>
                        <div id="workout-list" class="space-y-3 max-h-96 overflow-y-auto">
                            <div class="text-gray-400 text-center py-8">
                                Waiting for new workouts...
                            </div>
                        </div>
                    </div>

                    <div id="connection-status" class="mt-4 text-sm text-gray-400">
                        <span class="inline-block h-2 w-2 rounded-full bg-gray-500 mr-2"></span>
                        Connecting to broadcast service...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const connectionStatus = document.getElementById('connection-status');
            const statusIndicator = connectionStatus.querySelector('span');

            if (typeof window.Echo === 'undefined') {
                console.error('Laravel Echo is not defined. Check your configuration.');
                connectionStatus.innerHTML =
                    '<span class="inline-block h-2 w-2 rounded-full bg-red-500 mr-2"></span>' +
                    'Connection error. Broadcasting not available.';
                return;
            }

            Pusher.logToConsole = true;

            console.log('Echo config:', {
                key: '{{ env("PUSHER_APP_KEY") }}',
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            });

            window.Echo.connector.pusher.connection.bind('connected', () => {
                console.log('Connected to Pusher!');
                statusIndicator.classList.remove('bg-gray-500');
                statusIndicator.classList.add('bg-green-500');
                connectionStatus.innerHTML =
                    '<span class="inline-block h-2 w-2 rounded-full bg-green-500 mr-2"></span>' +
                    'Connected to broadcast service';
            });

            window.Echo.connector.pusher.connection.bind('disconnected', () => {
                statusIndicator.classList.remove('bg-green-500');
                statusIndicator.classList.add('bg-red-500');
                connectionStatus.innerHTML =
                    '<span class="inline-block h-2 w-2 rounded-full bg-red-500 mr-2"></span>' +
                    'Disconnected from broadcast service';
            });

            window.Echo.channel('workouts')
                .listen('.WorkoutRecorded', (e) => {
                    console.log('Received workout broadcast:', e);
                    displayWorkout(e);
                })
                .listen('WorkoutRecorded', (e) => {
                    console.log('Received workout broadcast (without dot):', e);
                    displayWorkout(e);
                });

            function displayWorkout(e) {
                console.log('Display function called with event data:', e);

                const workoutList = document.getElementById('workout-list');
                const placeholder = workoutList.querySelector('.text-center');

                if (placeholder) {
                    workoutList.innerHTML = '';
                }

                const newWorkout = document.createElement('div');
                newWorkout.className = 'bg-gray-700 rounded-md p-4 border-l-4 border-amber-400 animate-fade-in';

                const userName = e.user_name || 'A user';
                const workoutName = e.workout?.name || 'New workout';
                const exerciseCount = e.workout?.exercise_count || '?';
                const timestamp = new Date().toLocaleTimeString();

                newWorkout.innerHTML = `
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="h-10 w-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                                ${userName.charAt(0).toUpperCase()}
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-white">
                                <span class="font-bold">${userName}</span> just recorded a workout:
                                <span class="font-bold text-amber-400">${workoutName}</span>
                            </p>
                            <p class="text-sm text-gray-300 mt-1">
                                ${exerciseCount} ${exerciseCount === 1 ? 'exercise' : 'exercises'}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">• ${timestamp}</p>
                        </div>
                    </div>
                `;

                workoutList.prepend(newWorkout);

                const items = workoutList.querySelectorAll('.bg-gray-700');
                if (items.length > 20) {
                    items[items.length - 1].remove();
                }
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</x-layout>
