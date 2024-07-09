<x-guest-layout>
    <div class="container">
        <h1 class="text-xl font-semibold leading-tight text-gray-200">{{ $post->title }}</h1>

        @if($post->expiration_time)
        <p class="text-red-500">Expires at: <span id="expiration-time">{{ $post->expiration_time }}</span></p>
        @endif

        @if($post->view_limit !== null)
        <p class="text-red-500">Views left: {{ $post->view_limit - $post->views }}</p>
        @endif

        <div class="prose lg:prose-xl text-gray-300 mt-4">
            {!! $post->content !!}
        </div>
    </div>

    <script>
        // Countdown for expiration time
        document.addEventListener('DOMContentLoaded', function() {
            const expirationTimeElement = document.getElementById('expiration-time');
            if (expirationTimeElement) {
                const expirationTime = new Date(expirationTimeElement.textContent);
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
    </x-app-layout>