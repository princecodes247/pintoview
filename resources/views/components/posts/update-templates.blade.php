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


            <div class="overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('templates.store') }}" method="POST" class="text-white">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-300">Title</label>
                            <input type="text" name="name" id="name" class="w-full p-2 bg-gray-800 border-gray-600 rounded shadow-sm mt-1" value="{{ old('name') }}">
                            @error('name')
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
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="console.log('Creating Template...')">Create Template</button>
                    </div>
                </form>

    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });

    </script>
