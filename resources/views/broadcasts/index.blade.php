<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Workout Broadcasts</div>

                    <div class="card-body text-amber-400">
                        <h3>Recent Workouts</h3>
                        <div id="workout-list">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Echo.channel('workouts')
                .listen('WorkoutRecorded', (e) => {
                    const workoutList = document.getElementById('workout-list');
                    const newWorkout = document.createElement('div');
                    newWorkout.className = 'alert alert-info';
                    newWorkout.innerHTML = `<strong>${e.userName}</strong> just recorded a new workout: ${e.workout.name} - ${e.workout.duration} minutes`;
                    workoutList.prepend(newWorkout);
                });
        });
    </script>
@endpush
    <script>
        Pusher.logToConsole = true;

        console.log('Echo config:', {
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        });

        Echo.channel('workouts')
            .listen('WorkoutRecorded', (e) => {
                console.log('Received workout broadcast:', e);
            });
    </script>
</x-layout>
