<x-layout>
    <x-slot:heading>
        Edit Workout
    </x-slot:heading>

    <form method="POST" action="/workouts/{{ $workout->id }}" id="edit-workout-form">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <x-form-label for="date">Workout Date</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="date" name="date" id="date" :value="old('date', $workout->date->format('Y-m-d'))" required />
                            <x-form-error name="date" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <x-form-label for="name">Workout Name (Optional)</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="name" id="name" :value="old('name', $workout->name)" placeholder="e.g., Leg Day, Upper Body, etc." />
                            <x-form-error name="name" />
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <x-form-label for="notes">Notes (Optional)</x-form-label>
                        <div class="mt-2">
                            <textarea
                                id="notes"
                                name="notes"
                                rows="3"
                                class="block w-full rounded-md border-0 px-3 py-1.5 bg-white text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                            >{{ old('notes', $workout->notes) }}</textarea>
                            <x-form-error name="notes" />
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-base/7 font-semibold text-gray-600">Exercises</h3>

                    <div id="exercises-container">
                        <template id="exercise-template">
                            <div class="exercise-item mt-6 border border-gray-200 p-4 rounded-md">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-medium">Exercise <span class="exercise-number"></span></h4>
                                    <button type="button" class="remove-exercise text-red-500 text-sm font-medium">Remove</button>
                                </div>

                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label class="block text-sm/6 font-medium text-gray-600">Exercise</label>
                                        <div class="mt-2">
                                            <select name="exercises[INDEX][id]" required class="exercise-select block w-full rounded-md border-0 px-3 py-1.5 bg-white text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                                <option value="">Select an exercise</option>
                                                @foreach ($allExercises as $exercise)
                                                    <option value="{{ $exercise['id'] }}">{{ $exercise['name'] }} ({{ $exercise['muscle_group'] }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block text-sm/6 font-medium text-gray-600">Sets</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[INDEX][sets]" min="1" class="sets-input block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block text-sm/6 font-medium text-gray-600">Repetitions</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[INDEX][repetitions]" min="1" class="reps-input block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <label class="block text-sm/6 font-medium text-gray-600">Weight</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[INDEX][weight]" min="0" step="0.01" class="weight-input block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <label class="block text-sm/6 font-medium text-gray-600">Unit</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <select name="exercises[INDEX][unit]" required class="unit-select block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                                <option value="KGs">KGs</option>
                                                <option value="LBs">LBs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button type="button" id="add-exercise" class="mt-6 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Add Exercise
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" type="submit" onclick="return confirm('Are you sure you want to delete this workout?')" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/workouts/{{ $workout->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update
                </button>
            </div>
        </div>
    </form>

    <form method="POST" action="/workouts/{{ $workout->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const template = document.getElementById('exercise-template');
            const container = document.getElementById('exercises-container');
            const addButton = document.getElementById('add-exercise');

            const existingExercises = {!! json_encode($workout->exercises->map(function($exercise) {
                return [
                    'id' => $exercise->pivot->exercise_id,
                    'sets' => $exercise->pivot->sets,
                    'repetitions' => $exercise->pivot->repetitions,
                    'weight' => $exercise->pivot->weight,
                    'unit' => $exercise->pivot->unit,
                    'name' => $exerciseData['name'] ?? 'Unknown Exercise',
                    'muscle_group' => $exerciseData['muscle_group'] ?? 'Unknown Group'
                ];
            })) !!};

                /*
                    'id' => $exercise->pivot->exercise_id,
                    'sets' => $exercise->pivot->sets,
                    'repetitions' => $exercise->pivot->repetitions
                    'weight' => $exercise->pivot->weight,
                    'sets' => $exercise->pivot->sets,
                    'unit' => $exercise->pivot->unit,
                    'name' => $exerciseData['name'] ?? 'Unknown Exercise',
                    'muscle_group' => $exerciseData['muscle_group'] ?? 'Unknown Group'
                 */
            let exerciseCount = 0;

            function addExercise(exerciseData = null) {
                const exerciseNode = template.content.cloneNode(true);

                exerciseCount++;
                const exerciseNumber = exerciseNode.querySelector('.exercise-number');
                exerciseNumber.textContent = exerciseCount;

                const inputs = exerciseNode.querySelectorAll('[name*="[INDEX]"]');
                inputs.forEach(input => {
                    input.name = input.name.replace('INDEX', exerciseCount - 1);
                });

                const removeButton = exerciseNode.querySelector('.remove-exercise');
                removeButton.addEventListener('click', function() {
                    this.closest('.exercise-item').remove();
                    updateExerciseNumbers();
                });

                if (exerciseData) {
                    const selectElement = exerciseNode.querySelector('.exercise-select');
                    const setsInput = exerciseNode.querySelector('.sets-input');
                    const repsInput = exerciseNode.querySelector('.reps-input');
                    const weightInput = exerciseNode.querySelector('.weight-input');
                    const unitSelect = exerciseNode.querySelector('.unit-select');

                    selectElement.value = exerciseData.id;
                    setsInput.value = exerciseData.sets;
                    repsInput.value = exerciseData.repetitions;
                    weightInput.value = exerciseData.weight;
                    unitSelect.value = exerciseData.unit;
                }

                container.appendChild(exerciseNode);
            }

            function updateExerciseNumbers() {
                const exercises = container.querySelectorAll('.exercise-item');

                exercises.forEach((exercise, index) => {
                    exercise.querySelector('.exercise-number').textContent = index + 1;

                    const inputs = exercise.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        const newName = input.name.replace(/exercises\[\d+\]/, `exercises[${index}]`);
                        input.name = newName;
                    });
                });

                exerciseCount = exercises.length;
            }

            if (existingExercises.length > 0) {
                existingExercises.forEach(exercise => {
                    addExercise(exercise);
                });
            } else {
                addExercise();
            }

            addButton.addEventListener('click', function() {
                addExercise();
            });
        });
    </script>
</x-layout>
