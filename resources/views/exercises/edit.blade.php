<x-layout>
    <x-slot:heading>
        Edit exercise
    </x-slot:heading>

    <form method="POST" action="/exercises/{{ $exercise->id }}" id="edit-exercise-form">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <x-form-label for="name">Exercise Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="name" id="name" :value="old('name', $exercise->name)" placeholder="e.g. Bicep curls, Leg press etc." />
                            <x-form-error name="name" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <x-form-label for="muscle_group">Muscle Group</x-form-label>
                        <div class="mt-2">
                            <select id="muscle_group" name="muscle_group" class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">{{ 'Select a group' }}</option>
                                @foreach($muscleGroups as $group)
                                    <option value="{{ $group }}" @if($group == $exercise->muscle_group) selected="{{ $exercise->muscle_group }}" @endif>
                                        {{ $group }}
                                    </option>
                                @endforeach
                                <option value="other" {{ old('muscle_group') == 'other' ? 'selected' : '' }}>Other (specify)</option>
                            </select>
                            <x-form-error name="muscle_group" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" type="submit" onclick="return confirm('Are you sure you want to delete this exercise?')" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/exercises/{{ $exercise->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update
                </button>
            </div>
        </div>
    </form>

    <form method="POST" action="/exercises/{{ $exercise->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
