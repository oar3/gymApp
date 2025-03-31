<div class="mt-8">
    <h2 class="text-lg font-semibold mb-4">Exercises by Muscle Group</h2>

    @php
        $exercisesByGroup = \App\Models\Exercise::getExercisesByMuscleGroup();
    @endphp

    <div class="space-y-6">
        @foreach($exercisesByGroup as $muscleGroup => $exercises)
            <div>
                <h3 class="text-md font-medium text-gray-500 mb-2">{{ $muscleGroup }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($exercises as $exercise)
                        <div class="border border-gray-200 rounded-md p-3 bg-white/5 text-red-500">
                            <p class="font-medium">{{ $exercise['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
