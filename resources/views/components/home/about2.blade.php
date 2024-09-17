<section>
    <div class="relative max-w-screen-xl px-4 py-8 mx-auto mt-10 mb-6 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
        <img class="absolute z-0 -translate-y-1/3 top-10" src="https://farmui.vercel.app/bg-back.png" width={1000}
            height={1000} alt="back bg" />
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
            <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
                {{-- <img alt=""
                    src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                    class="absolute inset-0 object-cover w-full h-full" /> --}}
                <img alt="" src={{ asset('hero3.jpeg') }} class="absolute inset-0 object-cover w-full h-full" />
            </div>

            <div class="lg:py-24">
                <h2 class="text-3xl font-bold sm:text-4xl">Share Links to your Posts</h2>

                <p class="mt-4 text-gray-600">
                    share links to your contents to anyone, freinds, family, fans and even foes, and make profit while
                    doing so
                </p>
                {{-- 
                <a href="#"
                    class="inline-block px-12 py-3 mt-8 text-sm font-medium text-white transition bg-blue-600 rounded hover:bg-black focus:outline-none focus:ring focus:ring-yellow-400">
                    Get Started Today
                </a> --}}
            </div>
        </div>
    </div>
</section>
