<x-app-layout>
    <style>
        :root {
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
                    unlockAfterDiv.classList.remove('hidden');
                    unlockPriceDiv.classList.remove('hidden');
                } else {
                    unlockAfterDiv.classList.add('hidden');
                    unlockPriceDiv.classList.add('hidden');
                }
            });

            // Slug Generation
            const titleInput = document.querySelector('#title');
            const slugInput = document.querySelector('#slug');

            titleInput.addEventListener('input', function() {
                const slug = generateSlug(this.value);
                slugInput.value = slug;
            });

            slugInput.addEventListener('input', function() {
                const slug = generateSlug(this.value);
                slugInput.value = slug;
            });

            function generateSlug(title) {
                return title
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // Remove invalid characters
                    .trim() // Trim spaces
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/-+/g, '-'); // Replace multiple - with single -
            }
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

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="w-full text-white p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('title', $post->title ?? '') }}">
                            @error('title')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    @if(auth()->user()->isPremium())
                        <!-- Custom Slug -->
                        <div class="mb-4">
                            <label for="slug" class="block font-medium text-sm text-gray-300">Custom Slug (Optional)</label>
                            <input type="text" name="slug" id="slug" class="w-full text-white p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('slug', $post->slug ?? '') }}">
                            <p class="text-gray-400 text-xs mt-1">If left blank, a slug will be automatically generated based on the title.</p>
                            @error('slug')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                        <!-- Content -->
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
