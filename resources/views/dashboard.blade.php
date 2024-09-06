<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-trial-alert />

            {{-- Stats Summary Section --}}
            <x-stats-summary :viewsOverTime="$viewsOverTime" :topPosts="$topPosts" />

            <section class="py-12">
                <div class="flex items-center justify-between">
                    <x-dashboard-title>All Pages</x-dashboard-title>
                    <div class="flex items-center justify-between gap-2">
                        <a href="{{ route('posts.create') }}">
                            <x-button>
                                Create Post
                            </x-button>
                        </a>

                        {{-- Go to First Page --}}
                        @if ($posts->currentPage() > 1)
                        <a href="{{ $posts->url(1) }}">
                            <x-button>
                                <i class="fas fa-angle-double-left"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Previous Page --}}
                        @if ($posts->previousPageUrl())
                        <a href="{{ $posts->previousPageUrl() }}">
                            <x-button>
                                <i class="fas fa-angle-left"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Current Page and Total Pages --}}
                        <span class="px-3 text-white text-sm">
                            Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}
                        </span>

                        {{-- Next Page --}}
                        @if ($posts->nextPageUrl())
                        <a href="{{ $posts->nextPageUrl() }}">
                            <x-button>
                                <i class="fas fa-angle-right"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Go to Last Page --}}
                        @if ($posts->currentPage() < $posts->lastPage())
                            <a href="{{ $posts->url($posts->lastPage()) }}">
                                <x-button>
                                    <i class="fas fa-angle-double-right"></i>
                                </x-button>
                            </a>
                            @endif
                    </div>
                </div>
                <div class="mt-4">
                    <table class="w-full text-white">
                        <thead>
                            <tr class="bg-gray-800 border-b border-gray-700">
                                <th class="text-left p-3 rounded-tl-lg">Title</th>
                                <th class="text-left p-3">Link</th>
                                <th class="text-left p-3">Password</th>
                                <th class="text-left p-3">Views</th>
                                <th class="text-left p-3 rounded-tr-lg"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr class="border-b border-gray-700 text-sm bg-gray-800/50 hover:bg-gray-800 cursor-pointer">
                                <td class="pl-4 py-2">{{ $post->title }}</td>
                                <td class="pl-4 py-2">
                                    <a href="{{  route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                        {{ '/' . $post->short_link }}
                                    </a>
                                </td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    {{ $post->password }}
                                </td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    <p>{{ $post->views }}</p>
                                </td>
                                <td class="pl-4 py-2 flex space-x-2">
                                    <a href="{{ route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="py-12">
                <div class="flex items-center justify-between">
                    <x-dashboard-title>My Pins</x-dashboard-title>
                    <div class="flex items-center justify-between gap-2">
                        <a href="{{ route('posts.create') }}">
                            <x-button>
                                Create Post
                            </x-button>
                        </a>

                        {{-- Go to First Page --}}
                        @if ($postsWithPassword->currentPage() > 1)
                        <a href="{{ $postsWithPassword->url(1) }}">
                            <x-button>
                                <i class="fas fa-angle-double-left"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Previous Page --}}
                        @if ($postsWithPassword->previousPageUrl())
                        <a href="{{ $postsWithPassword->previousPageUrl() }}">
                            <x-button>
                                <i class="fas fa-angle-left"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Current Page and Total Pages --}}
                        <span class="px-3 text-white text-sm">
                            Page {{ $postsWithPassword->currentPage() }} of {{ $postsWithPassword->lastPage() }}
                        </span>

                        {{-- Next Page --}}
                        @if ($postsWithPassword->nextPageUrl())
                        <a href="{{ $postsWithPassword->nextPageUrl() }}">
                            <x-button>
                                <i class="fas fa-angle-right"></i>
                            </x-button>
                        </a>
                        @endif

                        {{-- Go to Last Page --}}
                        @if ($postsWithPassword->currentPage() < $postsWithPassword->lastPage())
                            <a href="{{ $postsWithPassword->url($postsWithPassword->lastPage()) }}">
                                <x-button>
                                    <i class="fas fa-angle-double-right"></i>
                                </x-button>
                            </a>
                            @endif
                    </div>
                </div>
                <div class="mt-4">
                    <table class="w-full text-white">
                        <thead>
                            <tr class="bg-gray-800 border-b border-gray-700">
                                <th class="text-left p-3 rounded-tl-lg">Title</th>
                                <th class="text-left p-3">Link</th>
                                <th class="text-left p-3">Password</th>
                                <th class="text-left p-3">Views</th>
                                <th class="text-left p-3 rounded-tr-lg"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postsWithPassword as $post)
                            <tr class="border-b border-gray-700 text-sm bg-gray-800/50 hover:bg-gray-800 cursor-pointer">
                                <td class="pl-4 py-2">{{ $post->title }}</td>
                                <td class="pl-4 py-2">
                                    <a href="{{  route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                        {{ '/' . $post->short_link }}
                                    </a>
                                </td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    {{ $post->password }}
                                </td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    <p>{{ $post->views }}</p>
                                </td>
                                <td class="pl-4 py-2 flex space-x-2">
                                    <a href="{{ route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]) }}" class="text-blue-500 hover:text-blue-700" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            {{--
            <section class="py-12">
                <x-dashboard-title>Affiliate link</x-dashboard-title>
            </section> --}}
        </div>
    </div>
</x-app-layout>
