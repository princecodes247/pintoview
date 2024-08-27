<x-app-layout>
    <style>
        :root {
            /* Overrides the border radius setting in the theme. */
            --ck-border-radius: 4px;
            --ck-color-base-border: #4b5563;
            --ck-color-base-background: #1f2937;
        }

        .ck-editor__editable_inline {
            min-height: 400px;
            background: #1f2937;
            color: #fff;
        }

        .hidden {
            display: none;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
   <script>
        let editor;

        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#body'))
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
            
            const passwordInput = document.querySelector('#password');
            const unlockAfterDiv = document.querySelector('#unlock_after_div');
            const unlockPriceDiv = document.querySelector('#unlock_price_div');

            passwordInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    {{-- unlockAfterDiv.classList.remove('hidden'); --}}
                    unlockPriceDiv.classList.remove('hidden');
                } else {
                    {{-- unlockAfterDiv.classList.add('hidden'); --}}
                    unlockPriceDiv.classList.add('hidden');
                }
            });
        });

        // Function to handle template selection
        function populateContent(templateContent) {
            if (editor) {
                editor.setData(templateContent);
            }
        }
    </script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ isset($post) ? __('Edit Post') : __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-900 border-b border-gray-700">
                    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
                        @csrf
                        @if(isset($post))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="w-full text-white p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('title', $post->title ?? '') }}">
                            @error('title')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach ($templates as $template)
                                <div class="p-3 bg-gray-800 rounded-lg border border-gray-700">
                                    <h3 class="text-sm font-semibold text-gray-200 truncate">{{ $template->name }}</h3>
                                    <p class="text-xs text-gray-400 mt-1 truncate">
                                        {{ \Illuminate\Support\Str::limit($template->content, 50, '...') }}
                                    </p>
                                    <button
                                        onclick="populateContent('{{ addslashes($template->content) }}')"
                                        class="mt-2 px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                                        type="button"
                                    >
                                        Select
                                    </button>
                                </div>
                            @endforeach

                            @if($templates->isEmpty())
                                <p class="col-span-full text-sm text-gray-500">You have no templates.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block font-medium text-sm text-gray-300">Content</label>
                            <textarea name="content" id="body" class="w-full p-2 text-white bg-gray-800 border-gray-600 rounded shadow-sm mt-1" rows="10">{{ old('content', $post->content ?? '') }}</textarea>
                            @error('content')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-gray-300">Password (Optional)</label>
                            <input type="password" name="password" id="password" class="w-full p-2 bg-gray-800 text-white border-gray-600 rounded shadow-sm mt-1" value="{{ old('password', $post->password ?? '') }}">
                            @error('password')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

<div id="unlock_price_div" class="hidden mb-4">
                            <label for="unlock_price" class="block font-medium text-sm text-gray-300">Unlock Price (Optional)</label>
                            <input type="number" name="unlock_price" id="unlock_price" class="w-full text-white p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('unlock_price') }}" min="1" step="1">
                            <p class="text-gray-400 text-xs mt-1">Enter the price to be paid to unlock this post.</p>
                            @error('unlock_price')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="unlock_after_div" class="hidden mb-4">
                            <label for="unlock_after" class="block font-medium text-sm text-gray-300">Unlock After (Optional)</label>
                            <input type="number" name="unlock_after" id="unlock_after" class="w-full  text-white p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('unlock_after') }}" min="1" step="1">
                            <p class="text-gray-400 text-xs mt-1">Enter the number of hours after which the post will be unlocked.</p>
                            @error('unlock_after')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-4">
                            <label for="expiration_time" class="block font-medium text-sm text-gray-300">Expiration Time (Optional)</label>
                            <input type="datetime-local" name="expiration_time" id="expiration_time" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('expiration_time', $post->expiration_time ?? '') }}">
                            @error('expiration_time')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        {{-- <div class="mb-4">
                            <label for="view_limit" class="block font-medium text-sm text-gray-300">View Limit (Optional)</label>
                            <input type="number" name="view_limit" id="view_limit" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('view_limit', $post->view_limit ?? '') }}">
                            @error('view_limit')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div> --}}
{{-- 
                        <div class="mb-4">
                            <label for="hidden_until" class="block font-medium text-sm text-gray-300">Hidden Until (Optional)</label>
                            <input type="datetime-local" name="hidden_until" id="hidden_until" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('hidden_until', $post->hidden_until ?? '') }}">
                            @error('hidden_until')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="console.log('{{ isset($post) ? 'Updating post...' : 'Creating post...' }}')">
                                {{ isset($post) ? 'Update Post' : 'Create Post' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
