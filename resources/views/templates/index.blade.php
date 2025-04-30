<x-layout>
    <x-slot:heading>
        My Templates
    </x-slot:heading>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white-800">Workout Templates</h2>
        <a href="/templates/create" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            New Template
        </a>
    </div>

    @if($templates->count() > 0)
        <div class="mb-4 flex flex-wrap justify-between items-center gap-2">
            <form method="GET" action="{{ request()->url() }}" class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 mr-2">
                    <label for="sort-by" class="text-sm text-gray-600">Sort by:</label>
                    <select id="sort-by" name="sort" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" onchange="this.form.submit()">
                        <option value="created_at" {{ request()->get('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                        <option value="name" {{ request()->get('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label for="direction" class="text-sm text-gray-600">Order:</label>
                    <select id="direction" name="direction" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" onchange="this.form.submit()">
                        <option value="desc" {{ request()->get('direction', 'desc') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request()->get('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>

                @if(request()->has('page'))
                    <input type="hidden" name="page" value="{{ request()->get('page') }}">
                @endif
            </form>
        </div>

        <div class="space-y-6">
            @foreach ($templates as $template)
                <div class="block px-6 py-4 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:text-gray-500">
                    <a href="/templates/{{ $template->id }}" class="block">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white-900">
                                {{ $template->name }}
                            </h3>
                            <span class="text-sm text-gray-500">Created {{ $template->created_at->format('F d, Y') }}</span>
                        </div>

                        <div class="mt-2">
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">{{ $template->exercises->count() }}</span>
                                {{ Str::plural('exercise', $template->exercises->count()) }}
                            </p>

                            @if($template->exercises->count() > 0)
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($template->exercises->take(3) as $exercise)
                                        @php
                                            $exerciseData = \App\Models\Exercise::find($exercise->pivot->exercise_id);
                                        @endphp
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                            {{ $exerciseData['name'] ?? 'Unknown Exercise' }}
                                        </span>
                                    @endforeach

                                    @if($template->exercises->count() > 3)
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            +{{ $template->exercises->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $templates->appends(request()->query())->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-12 border border-gray-200 rounded-lg">
            <p class="text-gray-500">You haven't created any workout templates yet.</p>
            <div class="mt-4">
                <a href="/templates/create" class="text-indigo-600 font-medium hover:text-indigo-500">Create your first template →</a>
            </div>
        </div>
    @endif
</x-layout>
