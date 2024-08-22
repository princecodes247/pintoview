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
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-900 border-b border-gray-700">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('title') }}">
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
                            <textarea name="content" id="body" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-gray-300">Password (Optional)</label>
                            <input type="password" name="password" id="password" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('password') }}">
                            @error('password')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="expiration_time" class="block font-medium text-sm text-gray-300">Expiration Time (Optional)</label>
                            <input type="datetime-local" name="expiration_time" id="expiration_time" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('expiration_time') }}">
                            @error('expiration_time')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="view_limit" class="block font-medium text-sm text-gray-300">View Limit (Optional)</label>
                            <input type="number" name="view_limit" id="view_limit" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('view_limit') }}">
                            @error('view_limit')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-4">
                            <label for="is_hidden" class="block font-medium text-sm text-gray-300">Is Hidden</label>
                            <input type="checkbox" name="is_hidden" id="is_hidden" class="p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="1" {{ old('is_hidden') ? 'checked' : '' }}>
                        @error('is_hidden')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                </div> --}}

                <div class="mb-4">
                    <label for="hidden_until" class="block font-medium text-sm text-gray-300">Hidden Until (Optional)</label>
                    <input type="datetime-local" name="hidden_until" id="hidden_until" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('hidden_until') }}">
                    @error('hidden_until')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="console.log('Creating post...')">Create Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
   
    
</x-app-layout>
