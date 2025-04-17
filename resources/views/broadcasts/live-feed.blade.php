<div class="workout-live-feed">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold text-white mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="10" stroke-width="2" class="opacity-75"></circle>
                <circle cx="12" cy="12" r="3" fill="currentColor"></circle>
            </svg>
            Live Workout Feed
        </h2>
        <div class="bg-gray-700 rounded-lg p-2">
            <div id="workout-feed-container" class="space-y-3 max-h-80 overflow-y-auto">
                <div class="text-gray-400 text-center py-8">
                    Waiting for new workouts...
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if Echo is properly defined
            if (typeof window.Echo === 'undefined') {
                console.error('Laravel Echo is not defined. Check your configuration.');
                document.getElementById('workout-feed-container').innerHTML =
                    '<div class="text-red-400 text-center py-4">Connection error. Broadcasting not available.</div>';
                return;
            }

            // Connect to the workouts channel
            window.Echo.channel('workouts')
                .listen('WorkoutRecorded', (e) => {
                    console.log('Received workout broadcast:', e);

                    // Create the workout notification element
                    const workoutItem = document.createElement('div');
                    workoutItem.className = 'bg-gray-600 rounded-md p-3 flex items-start animate-fade-in border-l-4 border-green-500';

                    // Format the workout data
                    const workoutName = e.workout?.name || 'New Workout';
                    const userName = e.user_name || 'A user';
                    const timestamp = new Date().toLocaleTimeString();

                    workoutItem.innerHTML = `
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                ${userName.charAt(0).toUpperCase()}
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-white">${userName} completed <span class="font-bold">${workoutName}</span></p>
                            <p class="text-xs text-gray-400 mt-1">Just now • ${timestamp}</p>
                        </div>
                    `;

                    // Add it to the container
                    const container = document.getElementById('workout-feed-container');

                    // Remove the waiting message if it's there
                    if (container.querySelector('.text-center')) {
                        container.innerHTML = '';
                    }

                    // Add the new workout to the top of the feed
                    container.prepend(workoutItem);

                    // Limit to 20 items to prevent overflow
                    const items = container.querySelectorAll('.bg-gray-600');
                    if (items.length > 20) {
                        items[items.length - 1].remove();
                    }
                });

            // Add a debug message to console
            console.log('Live workout feed initialized and listening on the "workouts" channel');
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
</div>
