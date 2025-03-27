@php
    $muscleGroups = array_keys(\App\Models\Exercise::getExercisesByMuscleGroup());
@endphp

<div class="mt-6 flex flex-wrap gap-2">
    @foreach($muscleGroups as $muscleGroup)
        <x-tag>{{ $muscleGroup }}</x-tag>
    @endforeach
</div>
