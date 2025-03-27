<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
    <x-form-field>
        <x-form-label for="date">Date</x-form-label>
        <div class="mt-2">
            <x-form-input type="date" value="{{ date('Y-m-d') }}" name="date" id="date" placeholder="{{ date('d-m-y') }}" required></x-form-input>

            <x-form-error name="date" />
        </div>
    </x-form-field>

    <x-form-field>
        <x-form-label for="exercise">Exercise</x-form-label>
        <div class="mt-2">
            <x-form-input name="exercise" id="exercise" placeholder="Squats" required></x-form-input>

            <x-form-error name="exercise" />
        </div>
    </x-form-field>

    <x-form-field>
        <x-form-label for="sets">Sets</x-form-label>

        <div class="mt-2">
            <x-form-input name="sets" id="sets" placeholder="5" required></x-form-input>

            <x-form-error name="sets" />
        </div>
    </x-form-field>

    <x-form-field>
        <x-form-label for="repetitions">Reps</x-form-label>

        <div class="mt-2">
            <x-form-input name="repetitions" id="repetitions" placeholder="10" required></x-form-input>

            <x-form-error name="repetitions" />
        </div>
    </x-form-field>

    <x-form-field>
        <x-form-label for="weight">Weight</x-form-label>

        <div class="mt-2">
            <x-form-input name="weight" id="weight" placeholder="10" required></x-form-input>

            <x-form-error name="weight" />
        </div>
    </x-form-field>
</div>

{{-- Added beyond lecture instruction from form template used here (edited country option list)--}}
<div class="mt-10 gap-y-8 sm:grid-cols-6">
    <label for="unit" class="block text-sm/6 font-medium text-gray-900">Unit</label>
    <div class="mt-2 grid grid-cols-1">
        <select id="unit" name="unit" class="col-start-1 row-start-1 w-50 appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            <option>KGs</option>
            <option>LBs</option>
        </select>
        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
    </div>
</div>
