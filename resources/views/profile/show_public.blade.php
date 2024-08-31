@section('title'){{ $user->name }} Profile @endsection

<x-guest-layout :theme="$user->default_post_theme">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- Profile Information -->
            <div class="flex items-center mb-4">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-24 w-24 object-cover mr-4">
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Social Links -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">{{ __('Social Links') }}</h2>
                <ul class="list-none">
                    @if($user->facebook)
                    <li>
                        <a href="{{ $user->facebook }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ __('Facebook') }}
                        </a>
                    </li>
                    @endif

                    @if($user->twitter)
                    <li>
                        <a href="{{ $user->twitter }}" target="_blank" class="text-blue-400 hover:underline">
                            {{ __('Twitter') }}
                        </a>
                    </li>
                    @endif

                    @if($user->whatsapp)
                    <li>
                        <a href="{{ $user->whatsapp }}" target="_blank" class="text-green-600 hover:underline">
                            {{ __('WhatsApp') }}
                        </a>
                    </li>
                    @endif

                    @if($user->telegram)
                    <li>
                        <a href="{{ $user->telegram }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ __('Telegram') }}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Custom Domain -->
            @if($user->custom_domain)
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-2">{{ __('Custom Domain') }}</h2>
                <p>
                    <a href="{{ $user->custom_domain }}" target="_blank" class="text-indigo-600 hover:underline">
                        {{ $user->custom_domain }}
                    </a>
                </p>
            </div>
            @endif
        </div>

        <!-- Free Posts -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">{{ __('Free Posts') }}</h2>
            @if($freePosts->isEmpty())
            <p class="text-gray-600">{{ __('No free posts available.') }}</p>
            @else
            <ul class="list-none">
                @foreach($freePosts as $post)
                <li class="mb-4">
                    <a href="{{ route('posts.show_public',  ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-indigo-600 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-600 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <!-- Locked Posts -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">{{ __('Locked Posts') }}</h2>
            @if($lockedPosts->isEmpty())
            <p class="text-gray-600">{{ __('No locked posts available.') }}</p>
            @else
            <ul class="list-none">
                @foreach($lockedPosts as $post)
                <li class="mb-4">
                    <a href="{{ route('posts.show_public',  ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-red-600 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-600 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</x-guest-layout>
