<x-layout>
    <x-slot:heading>
        Template Details
    </x-slot:heading>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $template->name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Created {{ $template->created_at->format('F d, Y') }}
            </p>
        </div>

        @if($template->description)
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-500">Description</h4>
                <p class="mt-1 text-sm text-gray-900">{{ $template->description }}</p>
            </div>
        @endif

        <div class="border-t border-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-500">Exercises</h4>

                <div class="mt-4 space-y-6">
                    @foreach($template->exercises as $exercise)
                        <div class="border border-gray-200 rounded-md p-4">
                            <h5 class="text-md font-semibold text-gray-900">
                                {{ $exercise->name }} <span class="text-sm font-normal text-gray-500">({{ $exercise->muscle_group }})</span>
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

    <div class="mt-6 flex space-x-3">
        <x-button href="{{ route('templates.edit', $template) }}">
            Edit Template
        </x-button>

        <a href="{{ route('templates.create-workout', $template) }}"
           class="bg-blue-600 text-white mt-6 py-2 px-4 rounded hover:bg-blue-700 inline-block">
            Use as Workout
        </a>

        <form method="POST" action="{{ route('templates.destroy', $template) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this template?')"
                    class="bg-red-600 hover:bg-red-700 text-white mt-6 py-2 px-4 rounded">
                Delete
            </button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('templates.index') }}" class="text-indigo-600 hover:text-indigo-500">← Back to templates</a>
    </div>
</x-layout>
