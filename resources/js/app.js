import './bootstrap';

Echo.channel('workouts')
    .listen('WorkoutRecorded', (e) => {
        console.log('New workout recorded:', e);

        const workout = e.workout;
        const userId = e.user_id;
    });

