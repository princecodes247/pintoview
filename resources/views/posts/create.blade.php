<x-app-layout>
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
                            <input type="text" name="title" id="title" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('title') }}" required>
                            @error('title')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
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

                        <div class="mb-4">
                            <label for="is_hidden" class="block font-medium text-sm text-gray-300">Is Hidden</label>
                            <input type="checkbox" name="is_hidden" id="is_hidden" class="p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="1" {{ old('is_hidden') ? 'checked' : '' }}>
                            @error('is_hidden')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="hidden_until" class="block font-medium text-sm text-gray-300">Hidden Until (Optional)</label>
                            <input type="datetime-local" name="hidden_until" id="hidden_until" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('hidden_until') }}">
                            @error('hidden_until')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="template_id" class="block font-medium text-sm text-gray-300">Template (Optional)</label>
                            <select name="template_id" id="template_id" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1">
                                <option value="">Select a Template</option>
                                @foreach ($templates as $template)
                                <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                    {{ $template->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('template_id')
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>