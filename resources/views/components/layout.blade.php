<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym App</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-black text-white">
<div class="px-10">
    <nav class="flex justify-between items-center py-4 border-b border-white/12">
        <div class="grid grid-cols-1">
            @auth
                @if(auth()->user()->is_admin)
                    <h3 class="ml-2 font-bold">Admin View</h3>
                @endif
            @endauth
            <a href="/">
                <img src="{{ Vite::asset('resources/images/dumbbell.svg') }}" class="invert h-24 w-24 mr-15" alt="dumbbell icon">
            </a>
        </div>

        <div class="space-x-6 font-bold font-stretch-125% max-md:grid max-md:ml-5 max-md:space-y-6 max-md:mt-5">
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/exercises" :active="request()->is('exercises')">Exercises</x-nav-link> {{-- Descriptions of exercises, correct form, muscles activated, anatomy etc. --}}
{{--            <x-nav-link href="/standards" :active="request()->is('standards')">Standards</x-nav-link> --}}{{-- Compare your lifts/run times (+ section for records & pbs?) --}}
            @auth
                <x-nav-link href="/workouts" :active="request()->is('workouts')">Workouts</x-nav-link> {{-- Compare your lifts/run times (+ section for records & pbs?) --}}
            @endauth
        </div>

        <div class="mt-0 space-x-6 font-bold font-stretch-125%">
            <div class="ml-4 flex items-center md:ml-4 max-md:grid max-md:grid-cols-1">
                @guest
                    <x-nav-link href="/login" class="bg-blue-100" :active="request()->is('login')">Log in</x-nav-link>
                    <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                @endguest

                @auth
                    <header class="bg-black shadow-sm">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                            <x-button href="/workouts/create" class="max-md:mt-0 hover:bg-gray-400">Create Workout</x-button>
                        </div>
                    </header>

                    <form method="POST" action="/logout">
                        @csrf

                        <x-form-button class="mt-4 max-sm:ml-4 max-md:ml-6 max-md:mt-0">Log out</x-form-button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="mt-10 max-w-[986px] mx-auto">
        {{ $slot }}
    </main>
</div>
</body>
</html>
