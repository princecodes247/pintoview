@section('title'){{ $user->name }}: {{ $post->title }}@endsection
@section('scripts')
{!! $embedCodes->content !!}

@endsection

<x-guest-layout :theme="$user->default_post_theme">
    <div class="container mx-auto p-6 max-w-4xl mt-8">
        @if (isset($headerBannerAd))
        <a href="{{ route('banner-ads.redirect', $headerBannerAd->id) }}" class="max-w-[728px] flex justify-center mx-auto">
            <img src="{{ $headerBannerAd->image }}" alt="{{ $headerBannerAd->title }}" class="w-full h-full object-contain hidden md:block">
            <img src="{{ $headerBannerAd->mobile_image }}" alt="{{ $headerBannerAd->title }}" class="object-contain block md:hidden">
        </a>
        @endif
        <div class="post-bg p-6 rounded-lg my-8 shadow-lg">
            <h1 class="text-2xl post-header font-bold leading-tight">{{ $post->title }}</h1>
            @if($topButtonAd)
            <div class="flex flex-wrap justify-center gap-4 mt-6">

                <a href="{{ $topButtonAd->direct_link }}" class="p-3 px-8 font-semibold text-white bg-blue-500 rounded">
                    {{ $topButtonAd->title }}
                </a>

            </div>
            @endif
            <p class="my-2">{{ $post->created_at }}</>
            </p>
            @if($post->expiration_time)
            <p class="mt-2 text-red-400">Expires at: <span id="expiration-time">{{ $post->expiration_time }}</span></p>
            @endif

            @if($post->view_limit !== null)
            <p class="mt-2 text-red-400">Views left: {{ $post->view_limit - $post->views }}</p>
            @endif

            <div class="prose lg:prose-xl w-full wrapCont post-content mt-6">
                {!! $post->content !!}
            </div>
            @if($bottomButtonAd)
            <div class="flex flex-wrap justify-center gap-4 mt-6">

                <a href="{{ $bottomButtonAd->direct_link }}" class="p-3 px-8 font-semibold text-white bg-blue-500 rounded">
                    {{ $bottomButtonAd->title }}
                </a>

            </div>
            @endif

        </div>
        @if (isset($footerBannerAd))
        <a href="{{ route('banner-ads.redirect', $footerBannerAd->id) }}" class="max-w-[728px] mx-auto block">
            <img src="{{ $footerBannerAd->image }}" alt="{{ $footerBannerAd->title }}" class="w-full h-full object-contain hidden md:block">
            <img src="{{ $footerBannerAd->mobile_image }}" alt="{{ $footerBannerAd->title }}" class="w-full h-full object-contain block md:hidden">
        </a>
        @endif
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
