<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-200">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-900 border-b border-gray-700">
                    <!-- Display the post content -->
                    <div class="prose lg:prose-xl text-gray-300">
                        {!! $post->content !!}
                    </div>

                    <!-- Display post details if applicable -->
                    <div class="mt-6">

                        @if($post->expiration_time)
                        <p><strong>Expires At:</strong> {{ $post->expiration_time }}</p>
                        @endif

                        @if($post->view_limit)
                        <p><strong>View Limit:</strong> {{ $post->view_limit }}</p>
                        @endif

                        @if($post->is_hidden)
                        <p><strong>Status:</strong> Hidden</p>
                        @else
                        <p><strong>Status:</strong> Visible</p>
                        @endif

                        @if($post->hidden_until)
                        <p><strong>Hidden Until:</strong> {{ $post->hidden_until }}</p>
                        @endif

                        @if($post->template)
                        <p><strong>Template:</strong> {{ $post->template->name }}</p>
                        @endif

                        <p><strong>Short Link:</strong> <a href="{{ url('/' . $post->short_link) }}" class="text-blue-500">{{ url('/' . $post->short_link) }}</a></p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>