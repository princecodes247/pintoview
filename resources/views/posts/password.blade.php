<x-app-layout>
    <div class="container">
        <h1 class="text-xl font-semibold leading-tight text-gray-200">{{ $post->title }}</h1>

        <form action="{{ route('posts.check_password', $post->short_link) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                @error('password')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>