<x-layout>
    <x-slot:heading>
        Create Workout from Template
    </x-slot:heading>

    <form method="POST" action="{{ route('workouts.store') }}" id="create-workout-form">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-bold text-gray-600">Create a New Workout from Template</h2>
                <p class="mt-1 text-sm/6 text-gray-500">Using template: <strong>{{ $template->name }}</strong></p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <x-form-label for="date">Workout Date</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="date" name="date" id="date" :value="old('date', date('Y-m-d'))" required />
                            <x-form-error name="date" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <x-form-label for="name">Workout Name (Optional)</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="name" id="name" :value="old('name', $template->name)" placeholder="e.g., Leg Day, Upper Body, etc." />
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
                                class="block w-full rounded-md border-0 py-1.5 bg-white text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                            >{{ old('notes', $template->description) }}</textarea>
                            <x-form-error name="notes" />
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-base/7 font-semibold text-gray-600">Exercises from Template</h3>
                    <div id="exercises-container" class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                        @foreach($template->exercises as $index => $exercise)
                            <div class="exercise-item mt-6 border border-gray-200 p-4 rounded-md">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-medium">{{ $exercise->name }}</h4>
                                    <button type="button" class="remove-exercise text-red-500 text-sm font-medium">Remove</button>
                                </div>

                                <input type="hidden" name="exercises[{{ $index }}][id]" value="{{ $exercise->id }}">

                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm/6 font-medium text-gray-600">Sets</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[{{ $index }}][sets]" min="1" value="{{ $exercise->pivot->sets }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block text-sm/6 font-medium text-gray-600">Repetitions</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[{{ $index }}][repetitions]" min="1" value="{{ $exercise->pivot->repetitions }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <label class="block text-sm/6 font-medium text-gray-600">Weight</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <input type="number" name="exercises[{{ $index }}][weight]" min="0" step="0.01" value="{{ $exercise->pivot->weight }}" class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <label class="block text-sm/6 font-medium text-gray-600">Unit</label>
                                        <div class="mt-2 bg-white block w-full rounded-md border-0">
                                            <select name="exercises[{{ $index }}][unit]" required class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                                <option value="KGs" {{ $exercise->pivot->unit == 'KGs' ? 'selected' : '' }}>KGs</option>
                                                <option value="LBs" {{ $exercise->pivot->unit == 'LBs' ? 'selected' : '' }}>LBs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('templates.show', $template) }}" class="text-sm/6 font-semibold text-gray-600">Cancel</a>
            <x-form-button>Save Workout</x-form-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('exercises-container');

            // Add remove functionality to the existing exercise items
            const removeButtons = document.querySelectorAll('.remove-exercise');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.exercise-item').remove();
                    updateExerciseNumbers();
                });
            });

            function updateExerciseNumbers() {
                const exercises = container.querySelectorAll('.exercise-item');

                exercises.forEach((exercise, index) => {
                    const inputs = exercise.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        const newName = input.name.replace(/exercises\[\d+\]/, `exercises[${index}]`);
                        input.name = newName;
                    });
                });
            }
        });
    </script>
</x-layout>
