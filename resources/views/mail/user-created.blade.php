<!DOCTYPE html>
<html lang="en">
<<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Gym App</title>
    <style>
        /* Base styles */
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Layout */
        .px-10 { padding-left: 2.5rem; padding-right: 2.5rem; }
        .max-w-\[986px\] { max-width: 986px; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .mt-10 { margin-top: 2.5rem; }
        .my-8 { margin-top: 2rem; margin-bottom: 2rem; }
        .p-6 { padding: 1.5rem; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-4 { margin-top: 1rem; }
        .mt-6 { margin-top: 1.5rem; }
        .ml-2 { margin-left: 0.5rem; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .p-3 { padding: 0.75rem; }
        .p-4 { padding: 1rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }

        /* Grid */
        .grid { display: grid; }
        .gap-4 { gap: 1rem; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }

        /* Flex */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .inline-flex { display: inline-flex; }

        /* Typography */
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .font-bold { font-weight: 700; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }

        /* Colors */
        .bg-black { background-color: #000000; }
        .text-white { color: #ffffff; }
        .text-indigo-700 { color: #4338ca; }
        .bg-white { background-color: #ffffff; }
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
        .from-indigo-600 { --tw-gradient-from: #4f46e5; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(79, 70, 229, 0)); }
        .to-blue-700 { --tw-gradient-to: #1d4ed8; }
        .bg-white\/10 { background-color: rgba(255, 255, 255, 0.1); }
        .bg-white\/20 { background-color: rgba(255, 255, 255, 0.2); }
        .text-white\/80 { color: rgba(255, 255, 255, 0.8); }
        .text-white\/70 { color: rgba(255, 255, 255, 0.7); }

        /* Sizing */
        .h-8 { height: 2rem; }
        .w-8 { width: 2rem; }
        .h-4 { height: 1rem; }
        .w-4 { width: 1rem; }

        /* Borders */
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-md { border-radius: 0.375rem; }
        .rounded-full { border-radius: 9999px; }

        /* Effects */
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }

        /* Transitions */
        .transition-colors { transition-property: color, background-color, border-color, fill, stroke; }
        .hover\:bg-indigo-50:hover { background-color: #eef2ff; }

        /* Responsive */
        @media (min-width: 768px) {
            .md\:flex-row { flex-direction: row; }
            .md\:mt-0 { margin-top: 0; }
            .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
    </style>
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
                        Welcome, {{$user->first_name}}!
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
