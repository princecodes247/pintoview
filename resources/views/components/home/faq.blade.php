@php
    $faqs = [
        [
            'question' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, aperiam?',
            'answer' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ullam labore sed assumenda exercitationem nulla laboriosam reprehenderit eligendi, obcaecati optio.',
        ],
        [
            'question' => 'Another frequently asked question goes here?',
            'answer' =>
                'And here is the detailed answer to the second question. It can be multiple sentences long and provide comprehensive information.',
        ],
        // Add more FAQ items as needed
    ];
@endphp


<section class="relative py-6 bg-gray-100">
    {{-- <div
        class="absolute -z-1 inset-0  h-[600px] w-full bg-transparent opacity-10 bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]">
    </div> --}}
    {{-- <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgb(138 132 252 / 0%) 20.79%, rgb(121 124 249 / 26%) 40.92%, rgb(171 188 238 / 0%) 70.35%)">
    </div> --}}
    {{-- <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgba(138, 132, 252, 0) 20%, rgba(121, 124, 249, 0.3) 50%, rgba(171, 188, 238, 0.1) 80%)">
    </div> --}}
    <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%)">
    </div>

    {{-- <img class="absolute z-0 -translate-y-1/3 top-10" src="https://farmui.vercel.app/bg-back.png" width={1000}
        height={1000} alt="back bg" /> --}}
    <h1 class="text-3xl font-extrabold text-center sm:text-5xl">
        <strong class="mb-10 font-extrabold text-blue-700 sm:block animate-pulse"> A Bit Confused ? </strong>
    </h1>
    <div
        class="flex flex-col items-center max-w-screen-xl gap-8 px-4 mx-auto mt-2 md:justify-evenly md:flex-row lg:h-screen">
        <div class="h-40 md:h-[70%] rounded-lg lg:mb-0 ">
            <img alt="" src="{{ asset('faqthinking.jpg') }}"
                class="inset-0 object-cover w-full h-full transition-transform transform -rotate-3 rounded-2xl" />
        </div>

        <div x-data="{ activeIndex: null }"
            class="z-10 flex flex-col w-full bg-white border-2 border-black rounded-lg shadow-lg min-h-fit md:w-1/2 inset-1">
            @foreach ($faqs as $index => $faq)
                <div class="border-b border-black last:border-b-0">
                    <button @click="activeIndex = activeIndex === {{ $index }} ? null : {{ $index }}"
                        class="flex items-center justify-between w-full p-4 font-semibold text-left focus:outline-none">
                        {{ $faq['question'] }}
                        <svg :class="{ 'rotate-180': activeIndex === {{ $index }} }"
                            class="w-5 h-5 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="activeIndex === {{ $index }}"
                        x-transition:enter="transition transform ease-out duration-500"
                        x-transition:enter-start="opacity-0 transform scale-95 max-h-0"
                        x-transition:enter-end="opacity-100 transform scale-100 h-fit"
                        x-transition:leave="transition transform ease-in-out duration-400"
                        x-transition:leave-start="opacity-100 transform scale-100 max-h-screen"
                        x-transition:leave-end="opacity-0 transform scale-95 max-h-0"class="p-4 overflow-hidden">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
