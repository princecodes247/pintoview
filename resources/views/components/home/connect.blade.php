<section class="relative bg-gray-200 max-h-fit">
    {{-- <div
        class="absolute -z-1 inset-0  h-[600px] w-full bg-transparent opacity-10 bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]">
    </div> --}}
    {{-- <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgb(138 132 252 / 0%) 20.79%, rgb(121 124 249 / 26%) 40.92%, rgb(171 188 238 / 0%) 70.35%)">
    </div> --}}
    {{-- <div class="absolute inset-0 h-full blur-xl"
        style="background: linear-gradient(143.6deg, rgba(138, 132, 252, 0) 20%, rgba(121, 124, 249, 0.3) 50%, rgba(171, 188, 238, 0.1) 80%)">
    </div> --}}

    {{-- <img class="absolute z-0 -translate-y-1/3 top-10" src="https://farmui.vercel.app/bg-back.png" width={1000}
        height={1000} alt="back bg" /> --}}

    <div
        class="flex flex-col h-full max-w-screen-xl gap-6 px-4 py-32 mx-auto justify-evenly md:flex-row lg:items-center">
        <div class="min-fit lg:py-16">
            <div class="rounded-lg h-54 lg:mb-0 sm:h-80 lg:h-full">
                <img alt="" src="{{ asset('connect.jpg') }}"
                    class="inset-0 object-cover w-full h-full transition-transform transform -rotate-3 rounded-2xl" />
            </div>
        </div>
        <div class="flex flex-col justify-center max-w-xl gap-2 mx-auto text-center">
            <h1 class="text-3xl font-extrabold sm:text-5xl">
                Want to more info about us ?
                {{-- <strong class="font-extrabold text-blue-700 sm:block"> Manage Views. </strong> --}}
            </h1>

            <div class="m-auto animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px"
                    fill="#1D4ED8">
                    <path
                        d="M480-83 240-323l56-56 184 183 184-183 56 56L480-83Zm0-238L240-561l56-56 184 183 184-183 56 56-240 240Zm0-238L240-799l56-56 184 183 184-183 56 56-240 240Z" />
                </svg>
            </div>

            <p class="mt-4 sm:text-xl/relaxed">
                Click here to get in contact with us
            </p>

            <a class="block w-full px-12 py-3 mt-6 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-black focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
                href="#">
                Get in touch
            </a>
        </div>
    </div>
</section>
