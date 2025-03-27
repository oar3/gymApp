<x-layout>
    <x-slot:heading>
        Workout Details
    </x-slot:heading>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $workout->name ?? 'Workout on ' . $workout->date->format('M d, Y') }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $workout->date->format('F d, Y') }}
            </p>
        </div>

        @if($workout->notes)
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $workout->notes }}</p>
            </div>
        @endif

        <div class="border-t border-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-500">Exercises</h4>

                <div class="mt-4 space-y-6">
                    @foreach($workout->exercises as $exercise)
                        @php
                            $exerciseData = \App\Models\Exercise::find($exercise->pivot->exercise_id);
                        @endphp
                        <div class="border border-gray-200 rounded-md p-4">
                            <h5 class="text-md font-semibold text-gray-900">
                                {{ $exerciseData['name'] }} <span class="text-sm font-normal text-gray-500">({{ $exerciseData['muscle_group'] }})</span>
                            </h5>

                            <div class="mt-2 grid grid-cols-3 gap-4 text-sm text-red-500">
                                <div>
                                    <span class="text-gray-500">Sets:</span>
                                    <span class="font-medium">{{ $exercise->pivot->sets }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Reps:</span>
                                    <span class="font-medium">{{ $exercise->pivot->repetitions }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Weight:</span>
                                    <span class="font-medium">{{ $exercise->pivot->weight }} {{ $exercise->pivot->unit }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @can('edit', $workout)
        <div class="mt-6 flex space-x-3">
            <x-button href="/workouts/{{ $workout->id }}/edit">
                Edit Workout
            </x-button>

            <form method="POST" action="/workouts/{{ $workout->id }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this workout?')"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                    Delete
                </button>
            </form>
        </div>
    @endcan

    <div class="mt-6">
        <a href="/workouts" class="text-indigo-600 hover:text-indigo-500">← Back to workouts</a>
    </div>
</x-layout>
