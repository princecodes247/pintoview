<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
    @foreach ($templates as $template)
        <div class="relative p-3 bg-gray-800 rounded border border-gray-600">
            <h3 class="text-sm font-semibold text-gray-200 truncate">{{ $template->name }}</h3>
            <p class="text-xs text-gray-400 mt-1 truncate">
                {{ \Illuminate\Support\Str::limit($template->content, 50, '...') }}
            </p>

            <!-- Delete Button -->
            <form action="{{ route('templates.destroy', $template->id) }}" method="POST" class="absolute top-1 right-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>
    @endforeach

    @if($templates->isEmpty())
        <p class="col-span-full text-sm text-gray-500">You have no templates.</p>
    @endif
</div>
