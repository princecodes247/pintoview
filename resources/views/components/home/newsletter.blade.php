<section class="relative bg-gray-50">
    {{-- <div
        class="absolute -z-1 inset-0  h-[600px] w-full bg-transparent opacity-10 bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]">
    </div> --}}
    {{-- <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgb(138 132 252 / 0%) 20.79%, rgb(121 124 249 / 26%) 40.92%, rgb(171 188 238 / 0%) 70.35%)">
    </div> --}}
    <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgba(138, 132, 252, 0) 20%, rgba(121, 124, 249, 0.3) 50%, rgba(171, 188, 238, 0.1) 80%)">
    </div>

    {{-- <img class="absolute z-0 -translate-y-1/3 top-10" src="https://farmui.vercel.app/bg-back.png" width={1000}
        height={1000} alt="back bg" /> --}}
    <div class="z-10 max-w-screen-xl px-4 py-32 mx-auto lg:flex lg:h-screen lg:items-center">
        <div class="z-10 max-w-xl mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Subscribe to our Newsletter
                {{-- <strong class="font-extrabold text-blue-700 sm:block"> Manage Views. </strong> --}}
            </h1>

            <p class="mt-4 sm:text-xl/relaxed">
                Get update info about services, new exciting features, offers and lots more
            </p>

            {{-- <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a class="block w-full px-12 py-3 text-sm font-medium text-white bg-blue-600 rounded shadow hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
                    href="#">
                    Get Started
                </a>

                <a class="block w-full px-12 py-3 text-sm font-medium text-blue-600 rounded shadow hover:text-blue-700 focus:outline-none focus:ring active:text-blue-500 sm:w-auto"
                    href="#">
                    Learn More
                </a>
            </div> --}}

            <div class="flex justify-center gap-4 mt-8">
                {{-- <form action="/submit" method="POST">
                    @csrf <!-- Include this for CSRF protection -->
                    <input type="email" id="newsletter" class="text-black" name="newsletter"
                        placeholder="enter your email">
                </form> --}}
                <input type="email" id="newsletter"
                    class="w-full text-black border-none rounded-md shadow-md outline-none" name="newsletter"
                    placeholder="enter your email">
                <button class="px-4 py-2 font-bold text-white bg-pink-600 rounded-lg hover:bg-black">Subscribe</button>
            </div>
        </div>
    </div>
</section>
