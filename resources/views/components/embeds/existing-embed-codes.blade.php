<div x-data="{ showModal: false, id: null, title: '', content: '', link: '' }">
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Existing Embed Codes') }}
            </x-slot>

            <x-slot name="description">
                {{ __('You may delete or edit any of your existing button ads if they are no longer needed.') }}
            </x-slot>

            <!-- Embed Codes List -->
            <x-slot name="content">
                @if($embedCodes->isEmpty())
                    <p class="text-white">No embed codes yet.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($embedCodes as $embedCode)
                            <div class="flex items-center justify-between gap-2">
                                <div class="break-all dark:text-white">
                                    {{ $embedCode->title }}
                                </div>

                                <div class="break-all text-sm dark:text-white">
                                    {{-- {{ $embedCode->content }} --}}
                                    {{ Str::limit($embedCode->content, 100, '...') }}
                                </div>

                                <div class="flex space-x-2">
                                    <button 
                                        class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 rounded-md px-3 py-1"
                                        x-on:click="showModal = true; id = {{ $embedCode->id }}; title = `{{ addslashes($embedCode->title) }}`; content = `{{ addslashes($embedCode->content) }}`; link = '{{ route('embed.update', $embedCode->id) }}'"
                                        >
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('embed.destroy', $embedCode->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-white bg-red-500 hover:bg-red-600 rounded-md px-3 py-1">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-slot>
        </x-action-section>
    </div>

    <!-- Edit Modal -->
    <div 
        x-show="showModal" 
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50"
        style="display: none;">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Edit Embed Code</h2>
            <form method="POST" x-bind:action="link">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <x-input type="text" name="title" id="title" x-model="title" class="w-full"/>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <x-textarea id="content" name="content" x-model="content" class="w-full h-40 p-2 border rounded-md dark:bg-gray-800 dark:text-white"></x-textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" x-on:click="showModal = false" class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md px-4 py-2 mr-2">Cancel</button>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
