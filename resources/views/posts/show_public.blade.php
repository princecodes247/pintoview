@section('title'){{ $user->name }}: {{ $post->title }}@endsection

<x-guest-layout>
    <div class="container mx-auto p-6 max-w-4xl mt-8">
        <div class="bg-gray-200 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold leading-tight text-gray-600">{{ $post->title }}</h1>

            @if($post->expiration_time)
            <p class="mt-2 text-red-400">Expires at: <span id="expiration-time">{{ $post->expiration_time }}</span></p>
            @endif

            @if($post->view_limit !== null)
            <p class="mt-2 text-red-400">Views left: {{ $post->view_limit - $post->views }}</p>
            @endif

            <div class="prose lg:prose-xl w-full wrapCont text-white mt-6">
                {!! $post->content !!}
            </div>


        </div>
    </div>
    <script>
        // Countdown for expiration time
        document.addEventListener('DOMContentLoaded', function() {
            const expirationTimeElement = document.getElementById('expiration-time');
            if (expirationTimeElement) {
                const expirationTime = new Date(expirationTimeElement.getAttribute('data-time'));
                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = expirationTime - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        expirationTimeElement.textContent = "This post has expired.";
                    } else {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        expirationTimeElement.textContent = `Expires in: ${hours}h ${minutes}m ${seconds}s`;
                    }
                }, 1000);
            }
        });
    </script>
</x-guest-layout>