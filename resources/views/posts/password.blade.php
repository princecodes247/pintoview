
@section('title'){{ $user->name }}: {{ $post->title }}@endsection

@php
    // Function to generate a random string of specified length
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Generate a random string of 16 characters
    $fakePostTitle = generateRandomString(16);
    $fakePostBody = generateRandomString(31);
@endphp

<x-guest-layout :theme="$user->default_post_theme">
    <style>
        /* Container styling */
        .container {
            position: relative;
            z-index: 1;
            padding: 20px;
        }

        /* Background styling */
        .background-blur {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0005;
            backdrop-filter: blur(10px); 
            {{-- opacity: 0.5; --}}
            {{-- z-index: 9999; --}}
        }

        /* Post content styling */
        .post-bg {
            position: relative;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .post-header {
            color: #e5e7eb; /* Tailwind gray-200 */
            margin-bottom: 20px;
        }

        .prose {
            color: #e5e7eb; /* Tailwind gray-200 */
        }
         .container {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            z-index: 1;
            position: relative;
        }

        /* Form styling */
        form {
            position: relative;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Input and button styling */
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #1f2937;
            color: #fff;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #3b82f6; /* Tailwind blue-500 */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2563eb; /* Tailwind blue-600 */
        }
    </style>


    <div class=" mx-auto p-6 max-w-4xl mt-8">
  

        <div class="post-bg p-6 rounded-lg my-8 shadow-lg">
            <h1 class="text-2xl post-header font-bold leading-tight">{{ $fakePostTitle }}</h1>

          

            @if($post->expiration_time)
                <p class="mt-2 text-red-400">Expires at: <span id="expiration-time">{{ $post->expiration_time }}</span></p>
            @endif

            @if($post->view_limit !== null)
                <p class="mt-2 text-red-400">Views left: {{ $post->view_limit - $post->views }}</p>
            @endif

            <div class="prose lg:prose-xl w-full wrapCont post-content mt-6">
                {!! $fakePostBody !!}
            </div>

        </div>

    </div>
    <div class="background-blur"></div>
     <div class="container">
        <h1>{{ $post->title }}</h1>

        <form action="{{ route('posts.check_password', ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="post-bg" method="POST">
            @csrf
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-300">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 flex gap-2">
                <button type="submit">Submit</button>
                <button type="button" class="bg-green-600 hover:bg-green-700">Unlock it!</button>
            </div>
        </form>
    </div>

</x-guest-layout>
