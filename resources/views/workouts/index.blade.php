<x-layout>
    <x-slot:heading>
        My Workouts
    </x-slot:heading>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">Workout History</h2>
        <a href="/workouts/create" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            New Workout
        </a>
    </div>

    @if($workouts->count() > 0)
        <div class="space-y-6">
            @foreach ($workouts as $workout)
                <div class="block px-6 py-4 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                    <a href="/workouts/{{ $workout->id }}" class="block">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $workout->name ?? 'Workout on ' . $workout->date->format('M d, Y') }}
                            </h3>
                            <span class="text-sm text-gray-500">{{ $workout->date->format('F d, Y') }}</span>
                        </div>

                        <div class="mt-2">
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">{{ $workout->exercises->count() }}</span>
                                {{ Str::plural('exercise', $workout->exercises->count()) }}
                            </p>

                            @if($workout->exercises->count() > 0)
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($workout->exercises->take(3) as $exercise)
                                        @php
                                            $exerciseData = \App\Models\Exercise::find($exercise->pivot->exercise_id);
                                        @endphp
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                            {{ $exerciseData['name'] ?? 'Unknown Exercise' }}
                                        </span>
                                    @endforeach

                                    @if($workout->exercises->count() > 3)
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            +{{ $workout->exercises->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $workouts->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-12 border border-gray-200 rounded-lg">
            <p class="text-gray-500">You haven't logged any workouts yet.</p>
            <div class="mt-4">
                <a href="/workouts/create" class="text-indigo-600 font-medium hover:text-indigo-500">Record your first workout →</a>
            </div>
        </div>
    @endif
</x-layout>
