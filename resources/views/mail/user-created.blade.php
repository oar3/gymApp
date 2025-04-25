<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Gym App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white">
<div class="px-10 max-w-[986px] mx-auto mt-10">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-lg shadow-lg p-6 my-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">
                        Welcome, John!
                    </h2>
                    <p class="text-white/80 mt-1">
                        Thank you for joining our fitness community. Your fitness journey starts now!
                    </p>
                </div>
            </div>

            <div class="mt-4 md:mt-0">
                <a href="/workouts/create" class="inline-flex items-center px-4 py-2 bg-white text-indigo-700 rounded-md font-semibold text-sm shadow-sm hover:bg-indigo-50 transition-colors">
                    Create Your First Workout
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white/10 p-4 rounded-lg">
                <h3 class="text-white font-medium">Track Your Progress</h3>
                <p class="text-white/70 text-sm mt-1">Log workouts and monitor your strength improvements over time.</p>
            </div>
            <div class="bg-white/10 p-4 rounded-lg">
                <h3 class="text-white font-medium">Explore Exercises</h3>
                <p class="text-white/70 text-sm mt-1">Discover new exercises or create custom ones specific to your routine.</p>
            </div>
            <div class="bg-white/10 p-4 rounded-lg">
                <h3 class="text-white font-medium">Stay Consistent</h3>
                <p class="text-white/70 text-sm mt-1">Build the habit by regularly logging your workouts.</p>
            </div>
        </div>

        <!-- Optional custom content would go here -->
    </div>
</div>
</body>
</html>
