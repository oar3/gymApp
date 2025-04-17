<x-layout>
    <x-slot:heading>
        Add New Exercise
    </x-slot:heading>

    <form method="POST" action="/exercises" class="max-w-2xl mx-auto" id="create-exercise-form">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Create a new exercise to add to your workouts.
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <x-form-label for="name">Exercise Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="name" id="name" :value="old('name')" required autofocus />
                            <x-form-error name="name" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <x-form-label for="muscle_group_option">Muscle Group</x-form-label>
                        <div class="mt-2">
                            <select id="muscle_group_option" name="muscle_group_option" onchange="muscleGroupSelect()" class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">Select option</option>
                                <option id="muscle_group_existing" value="existing" {{ old('muscle_group_option') == 'existing' ? 'selected' : '' }}>Use existing muscle group</option>
                                <option id="muscle_group_new" value="new" {{ old('muscle_group_option') == 'new' ? 'selected' : '' }}>Create new muscle group</option>
                            </select>
                            <x-form-error name="muscle_group_option" />
                        </div>
                    </div>

                    <div class="sm:col-span-4" id="existing_muscle_group_container" style="{{ old('muscle_group_option') == 'existing' ? '' : 'display: none;' }}">
                        <x-form-label for="muscle_group">Select Muscle Group</x-form-label>
                        <div class="mt-2">
                            <select id="muscle_group" name="muscle_group" class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">{{ 'Select a group' }}</option>
                                <optgroup label="Default Groups">
                                    @foreach($muscleGroups->where('user_id', null) as $group)
                                        <option value="{{ $group->id }}" {{ old('muscle_group') == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                @if($muscleGroups->where('user_id', auth()->id())->count() > 0)
                                    <optgroup label="My Custom Groups">
                                        @foreach($muscleGroups->where('user_id', auth()->id()) as $group)
                                            <option value="{{ $group->id }}" {{ old('muscle_group') == $group->id ? 'selected' : '' }}>
                                                {{ $group->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            </select>
                            <x-form-error name="muscle_group" />
                        </div>
                    </div>

                    <div class="sm:col-span-4" id="new_muscle_group_container" style="{{ old('muscle_group_option') == 'new' ? '' : 'display: none;' }}">
                        <x-form-label for="new_muscle_group">New Muscle Group</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="new_muscle_group" id="new_muscle_group" :value="old('new_muscle_group')" />
                            <x-form-error name="new_muscle_group" />
                        </div>
                    </div>

                    <div class="col-span-full">
                        <x-form-label for="description">Description (Optional)</x-form-label>
                        <div class="mt-2">
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                            >{{ old('description') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">
                                Add any helpful notes about how to perform this exercise.
                            </p>
                            <x-form-error name="description" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <a href="/exercises" class="text-sm/6 font-semibold text-gray-600">Cancel</a>
            <x-form-button>Save Exercise</x-form-button>
        </div>
    </form>

    <script>
        function muscleGroupSelect() {
            const selectedOption = document.getElementById("muscle_group_option").value;

            const existingContainer = document.getElementById("existing_muscle_group_container");
            const newContainer = document.getElementById("new_muscle_group_container");

            existingContainer.style.display = "none";
            newContainer.style.display = "none";

            if (selectedOption === "existing") {
                existingContainer.style.display = "block";
                document.getElementById("muscle_group").required = true;
                document.getElementById("new_muscle_group").required = false;
            } else if (selectedOption === "new") {
                newContainer.style.display = "block";
                document.getElementById("new_muscle_group").required = true;
                document.getElementById("muscle_group").required = false;
            }
        }
    </script>
</x-layout>
