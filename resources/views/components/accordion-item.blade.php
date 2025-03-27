<div class="border-b border-slate-200">
    <button onclick="toggleAccordion({{ $exerciseType -> 'id' }})" class="w-full flex justify-between items-center py-5 text-slate-800">
        <span>Arms</span>
        <span id="icon-1" class="text-slate-800 transition-transform duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
      </svg>
    </span>
    </button>
    <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
        <div class="pb-5 text-sm text-slate-500">
            {{-- Exercise list belonging to type --}}
        </div>
    </div>
</div>
