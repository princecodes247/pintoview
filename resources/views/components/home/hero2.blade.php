<section class="relative flex flex-col items-center justify-center min-h-screen ">
    <div
        class="absolute bg-center bg-[url('../images/hero2.jpg')]  bg-transparent bg-cover bg-blend-overlay inset-0 h-full ">
    </div>
    <div class="absolute w-full h-full bg-gray-100 opacity-90"></div>
    <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgb(138 132 252 / 0%) 20.79%, rgb(121 124 249 / 26%) 40.92%, rgb(171 188 238 / 0%) 70.35%)">
    </div>
    <div class="relative">
        <div
            class="z-10 items-center justify-center max-w-screen-xl gap-12 px-4 mx-auto overflow-hidden text-black py-28 md:px-8 md:flex">
            <div class="flex flex-col items-center flex-none max-w-xl space-y-5">
                <a href="javascript:void(0)"
                    class="inline-flex items-center p-1 pr-6 text-sm font-medium duration-150 border-2 rounded-full border-white/60 gap-x-6 hover:bg-transparent/10">
                    <span class="inline-block px-3 py-1 text-white bg-pink-600 rounded-full">
                        News
                    </span>
                    <p class="flex items-center">
                        Read the launch post from here
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fillRule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clipRule="evenodd" />
                        </svg>
                    </p>
                </a>
                <h1
                    class="text-center max-w-md md:max-w-3xl text-3xl  md:text-4xl tracking-tighter mr-auto lg:text-6xl font-geist font-extrabold  text-transparent bg-clip-text bg-[linear-gradient(180deg,_#000_0%,_rgba(255,_255,_255,_0.00)_202.08%)] leading-0 md:leading-0 md:pb-0 mt-1">
                    {{-- Create pages that you can monetize Instantly --}}
                    <span style=" color: rgb(37 99 235 / var(--tw-bg-opacity))">Create</span> pages you can instantly
                    <span style=" color: rgb(37 99 235 / var(--tw-bg-opacity))">monetize</span>
                </h1>
                {{-- <p class="text-center">
                    Sed ut perspiciatis unde omnis iste natus voluptatem accusantium
                    doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                </p> --}}
                <div class="flex items-center gap-x-3 sm:text-sm">
                    <a href="{{ route('login') }}"
                        class="flex items-center hover:bg-black transition-colors duration-300 justify-center gap-x-1 py-3 px-4 bg-blue-600 text-white font-medium transform-gpu dark:[border:1px_solid_rgba(255,255,255,.1)] dark:[box-shadow:0_-20px_80px_-20px_#8686f01f_inset] rounded-full md:inline-flex">
                        Get started
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fillRule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clipRule="evenodd" />
                        </svg>
                    </a>
                    <a href="javascript:void(0)"
                        class="flex items-center justify-center px-4 py-4 font-bold text-black duration-150 gap-x-1 hover:text-blue-700 md:inline-flex">
                        Learn more
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
