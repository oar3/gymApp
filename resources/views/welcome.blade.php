<x-layout>
    <div class="space-y-10">
        <section>
            <x-section-heading>Popular Exercises</x-section-heading>

            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @php
                    $popularExercises = \App\Models\Exercise::getAllExercises()->take(3);
                @endphp

                @foreach($popularExercises as $exercise)
                    <x-card>
                        <h3 class="font-medium text-lg">{{ $exercise['name'] }}</h3>
                        <p class="text-gray-600">{{ $exercise['muscle_group'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>Muscle groups</x-section-heading>

            <x-muscle-group-tags />
        </section>

        <section>
            <x-live-feed></x-live-feed>
        </section>
    </div>
</x-layout>
