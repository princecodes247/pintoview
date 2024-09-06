@section('title'){{ $user->name }} Profile @endsection

<x-guest-layout :theme="$user->default_post_theme">
    <div class="container mx-auto p-4 max-w-lg">
        <div class="post-bg p-6 rounded-lg shadow text-center">
            <!-- Profile Information -->
            <div class="mb-6">
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-24 w-24 object-cover mx-auto mb-4">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                {{-- <p class="text-gray-600">{{ $user->email }}</p> --}}
            </div>

            <!-- Social Links -->
            <div class="mt-6">
                <ul class="list-none space-y-3">
                    @if($user->facebook)
                    <li>
                        <a href="{{ $user->facebook }}" target="_blank" class="block text-white bg-blue-600 rounded-lg px-4 py-2 hover:bg-blue-700">
                            {{ __('Facebook') }}
                        </a>
                    </li>
                    @endif

                    @if($user->twitter)
                    <li>
                        <a href="{{ $user->twitter }}" target="_blank" class="block text-white bg-blue-400 rounded-lg px-4 py-2 hover:bg-blue-500">
                            {{ __('Twitter') }}
                        </a>
                    </li>
                    @endif

                    @if($user->whatsapp)
                    <li>
                        <a href="{{ $user->whatsapp }}" target="_blank" class="block text-white bg-green-600 rounded-lg px-4 py-2 hover:bg-green-700">
                            {{ __('WhatsApp') }}
                        </a>
                    </li>
                    @endif

                    @if($user->telegram)
                    <li>
                        <a href="{{ $user->telegram }}" target="_blank" class="block text-white bg-blue-500 rounded-lg px-4 py-2 hover:bg-blue-600">
                            {{ __('Telegram') }}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Custom Domain -->
            @if($user->custom_domain)
            <div class="mt-6">
                <a href="{{ $user->custom_domain }}" target="_blank" class="block text-white bg-indigo-600 rounded-lg px-4 py-2 hover:bg-indigo-700">
                    {{ __('Visit My Website') }}
                </a>
            </div>
            @endif

            <!-- Search Form -->
            <div class="mt-6">
                <form method="GET" action="{{ route('user.profile_public', ['user_slug' => $user->slug]) }}" class="flex gap-2 md:flex-row flex-col">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}" placeholder="Search posts..." class="w-full flex-1 p-2 border border-gray-200 rounded-lg" />
                    <button type="submit" class="h-full px-6 bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                        {{ __('Search') }}
                    </button>
                </form>
            </div>

        </div>

        <!-- Free Posts -->
        <div class="mt-8 post-bg p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">{{ __('Free Posts') }}</h2>
            @if($freePosts->isEmpty())
            <p class="text-gray-600">{{ __('No free posts available.') }}</p>
            @else
            <ul class="list-none space-y-3">
                @foreach($freePosts as $post)
                <li>
                    <a href="{{ route('posts.show_public',  ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="block text-indigo-600 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                </li>
                @endforeach
            </ul>

            <div class="mt-6">
            {{ $freePosts->links() }}
            </div>
            @endif
        </div>

        <!-- Locked Posts -->
        <div class="mt-8 post-bg p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">{{ __('Locked Posts') }}</h2>
            @if($lockedPosts->isEmpty())
            <p class="text-gray-600">{{ __('No locked posts available.') }}</p>
            @else
            <ul class="list-none space-y-3">
                @foreach($lockedPosts as $post)
                <li>
                    <a href="{{ route('posts.show_public',  ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="block text-red-600 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                </li>
                @endforeach
            </ul>
               <div class="mt-6">
            {{ $lockedPosts->links() }}
            </div>
            @endif
        </div>
    </div>
</x-guest-layout>
