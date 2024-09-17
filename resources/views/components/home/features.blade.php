@php
    $features = [
        [
            'title' => 'Create Content',
            'description' => 'Craft engaging content, share creativity and bring ideas to life.',
        ],
        [
            'title' => 'Share Links',
            'description' => 'Generate custom links for your content and share them across platforms.',
        ],
        [
            'title' => 'Monetize Content',
            'description' => 'Turn your passion into profit with various monetization options.',
        ],
        [
            'title' => 'Analytics Dashboard',
            'description' => 'Track your performance with detailed insights.',
        ],
    ];
@endphp

<style>
    [x-cloak] {
        display: none !important;
    }
</style>


<section x-data="carousel()" x-init="startAutoplay()" class="min-h-[80vh] p-4 py-6 text-white bg-gray-900">
    {{-- <div class="max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16"> --}}
    <div class="max-w-xl">
        <h2 class="text-3xl font-bold sm:text-4xl">What makes us special</h2>

        <p class="mt-4 text-gray-300">
            we pride ourselves on delivering a unique and unparalleled experience. Our platform stands out with its
            seamless integration of advanced features designed to enhance user engagement and satisfaction
        </p>
    </div>

    <div class="relative overflow-hidden h-[300px]">
        @foreach ($features as $index => $feature)
            <div x-show="currentIndex === {{ $index }}" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full" x-cloak
                class="absolute inset-0 flex flex-col items-center w-full p-8 mt-6 transition-all duration-300 ease-linear transform rounded-lg shadow-lg">


                @if ($index == 0)
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#1D4ED8">
                        <path
                            d="M440-240h80v-120h120v-80H520v-120h-80v120H320v80h120v120ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
                    </svg>
                @elseif ($index == 1)
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#1D4ED8">
                        <path
                            d="M680-80q-50 0-85-35t-35-85q0-6 3-28L282-392q-16 15-37 23.5t-45 8.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 8.5t37 23.5l281-164q-2-7-2.5-13.5T560-760q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-24 0-45-8.5T598-672L317-508q2 7 2.5 13.5t.5 14.5q0 8-.5 14.5T317-452l281 164q16-15 37-23.5t45-8.5q50 0 85 35t35 85q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T720-200q0-17-11.5-28.5T680-240q-17 0-28.5 11.5T640-200q0 17 11.5 28.5T680-160ZM200-440q17 0 28.5-11.5T240-480q0-17-11.5-28.5T200-520q-17 0-28.5 11.5T160-480q0 17 11.5 28.5T200-440Zm480-280q17 0 28.5-11.5T720-760q0-17-11.5-28.5T680-800q-17 0-28.5 11.5T640-760q0 17 11.5 28.5T680-720Zm0 520ZM200-480Zm480-280Z" />
                    </svg>
                @elseif($index == 2)
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#1D4ED8">
                        <path
                            d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#1D4ED8">
                        <path
                            d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z" />
                    </svg>
                @endif

                <h3 class="mb-4 text-2xl font-bold">{{ $feature['title'] }}</h3>
                <p class="max-w-md text-center text-white">{{ $feature['description'] }}</p>
            </div>
        @endforeach
        <button @click="prev()"
            class="absolute left-0 p-2 transform flex justify-center items-center -translate-y-1/2 h-[3.5rem] w-[3.5rem] bg-gray-100 rounded-full shadow-md top-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#1D4ED8">
                <path d="M640-80 240-480l400-400 71 71-329 329 329 329-71 71Z" />
            </svg>
        </button>
        <button @click="next()"
            class="absolute right-0 p-2 transform flex justify-center items-center -translate-y-1/2 h-[3.5rem] w-[3.5rem] bg-gray-100 rounded-full shadow-md top-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                fill="#1D4ED8">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg>
        </button>
    </div>
    <div class="flex justify-center mt-10">
        @foreach ($features as $index => $feature)
            <div class="w-6 h-6 mx-1 rounded-full"
                :class="{
                    'bg-blue-500': currentIndex === {{ $index }},
                    'bg-gray-300': currentIndex !==
                        {{ $index }}
                }">
            </div>
        @endforeach
    </div>
    <script>
        function carousel() {
            return {
                currentIndex: 0,
                features: @json($features),
                direction: 'right',
                autoplay: null,
                next() {
                    this.direction = 'right';
                    this.currentIndex = (this.currentIndex + 1) % this.features.length;
                },
                prev() {
                    this.direction = 'left';
                    this.currentIndex = (this.currentIndex - 1 + this.features.length) % this.features.length;
                },
                startAutoplay() {
                    this.autoplay = setInterval(() => this.next(), 5000);
                },
                stopAutoplay() {
                    clearInterval(this.autoplay);
                }
            }
        }
    </script>
</section>
