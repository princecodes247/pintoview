<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <section class="py-12">
                <div class="flex items-center justify-between">

                    <x-dashboard-title>My Pins</x-dashboard-title>
                    <div class="flex items-center justify-between gap-2">


                        <a href="{{ route('posts.create') }}">
                            <x-button>
                                Create Post
                            </x-button>
                        </a>
                        @if ($posts->previousPageUrl())
                        <a href="{{ $posts->previousPageUrl() }}">
                            <x-button>
                                <span>&lt;</span>
                            </x-button>
                        </a>
                        @endif
                        @if ($posts->nextPageUrl())
                        <a href="{{ $posts->nextPageUrl() }}">
                            <x-button>
                                <span>&gt;</span>
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
                                <td class="pl-4 py-2"><a href="{{ env('APP_URL') . '/' . $user->slug . '/' . $post->short_link }}" class="text-blue-500 hover:text-blue-700">{{ '/' . $post->short_link }}</a></td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    {{ $post->password }}
                                </td>
                                <td class="pl-4 py-2 text-xs text-gray-400">
                                    <p>{{ $post->views }}</p>
                                </td>
                                <td class="pl-4 py-2">

                                    <x-button>
                                        D
                                    </x-button>
                                    <x-button>
                                        D
                                    </x-button>
                                    <x-button>
                                        D
                                    </x-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            {{-- <x-section-border /> --}}

            <section class="py-12">
                <x-dashboard-title>Developers</x-dashboard-title>
                @livewire('api-token-manager2')

            </section>
            {{-- <x-section-border /> --}}

            <section class="py-12">
                <x-dashboard-title>Affiliate link</x-dashboard-title>

            </section>
        </div>
    </div>
</x-app-layout>
