<x-landing-layout>
    <div class="bg-white min-h-screen">
        <header class="container mx-auto py-12 text-center">
            <h1 class="text-4xl font-bold text-gray-900">Contact Us</h1>
            <p class="mt-4 text-lg text-gray-600">
                We're here to help! Feel free to reach out to us with any questions or inquiries.
            </p>
        </header>

        <main class="container mx-auto py-16 px-6 lg:px-12">
            <section class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Get in Touch</h2>
                <p class="mt-6 text-lg text-gray-700">
                    Whether you have a question about features, pricing, or anything else, our team is ready to answer all your questions.
                </p>
            </section>

            <section class="mt-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information -->
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900">Contact Information</h3>
                        <p class="mt-4 text-gray-700">
                            You can contact us via email.
                            {{-- You can contact us via email or phone, or visit our office at the following address. --}}
                        </p>

                        <div class="mt-6 text-left">
                            <p class="text-lg font-semibold text-gray-900">Email:</p>
                            <p class="text-gray-700">info@pintoview.com</p>
                        </div>
{{-- 
                        <div class="mt-6 text-left">
                            <p class="text-lg font-semibold text-gray-900">Phone:</p>
                            <p class="text-gray-700">+1 (555) 123-4567</p>
                        </div> --}}
{{-- 
                        <div class="mt-6 text-left">
                            <p class="text-lg font-semibold text-gray-900">Address:</p>
                            <p class="text-gray-700">
                                123 Creator Lane,<br />
                                Suite 200,<br />
                                Creatorsville, CA 90001
                            </p>
                        </div> --}}
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-gray-100 p-8 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold text-gray-900">Send Us a Message</h3>
                         
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg my-6">{{ session('success') }}</div>
    @endif
     @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg my-6">
                {{ session('error') }}
            </div>
            @endif

                        <form class="mt-6" action="{{ route('contact.submit') }}" method="POST">
                         @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-left text-lg font-semibold text-gray-900">Name</label>
                                <input id="name" type="text" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" placeholder="Your full name">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-left text-lg font-semibold text-gray-900">Email</label>
                                <input id="email" type="email" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" placeholder="Your email address">
                            </div>

                            <div class="mb-4">
                                <label for="message" class="block text-left text-lg font-semibold text-gray-900">Message</label>
                                <textarea id="message" rows="5" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" placeholder="Write your message here"></textarea>
                            </div>

                            <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            {{-- <section class="mt-16 text-center">
                <h2 class="text-3xl font-bold text-gray-900">Follow Us</h2>
                <p class="mt-4 text-lg text-gray-700">
                    Stay updated with the latest news and updates from our platform. Follow us on social media!
                </p>
                <div class="flex justify-center mt-6 space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M22.46 6.03c-.77.34-1.61.57-2.48.68.89-.53 1.57-1.36 1.88-2.35-.83.5-1.74.86-2.71 1.06a4.49 4.49 0 00-7.66 4.09c-3.74-.19-7.04-1.97-9.26-4.68a4.48 4.48 0 00-.61 2.26c0 1.56.8 2.93 2.03 3.73-.74-.02-1.43-.23-2.04-.57v.06c0 2.18 1.55 4.01 3.6 4.43-.38.1-.77.15-1.18.15-.29 0-.57-.03-.84-.08.57 1.77 2.21 3.06 4.15 3.1A9.02 9.02 0 012 20.26 12.73 12.73 0 007.29 22c8.3 0 12.84-6.88 12.84-12.84 0-.2 0-.4-.01-.59A9.18 9.18 0 0024 6.47a8.76 8.76 0 01-2.54.7z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19.7 3H4.3C3.58 3 3 3.58 3 4.3v15.4c0 .72.58 1.3 1.3 1.3h8.29V14.7h-2.1v-2.64h2.1V9.77c0-2.07 1.26-3.21 3.12-3.21.88 0 1.64.07 1.86.1v2.15h-1.28c-1 0-1.2.48-1.2 1.18v1.55h2.39l-.31 2.64h-2.08v6.3h4.09c.72 0 1.3-.58 1.3-1.3V4.3c0-.72-.58-1.3-1.3-1.3z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800 transition duration-300">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M22 11.08v1.84c0 6.26-4.77 13.48-13.48 13.48A13.44 13.44 0 010 18.5a9.83 9.83 0 007.19 2.06A6.7 6.7 0 013.5 15.54a8.38 8.38 0 002.76-.1A6.68 6.68 0 011.34 9.8v-.09A6.73 6.73 0 004.85 11 6.71 6.71 0 011.68 4.94a6.64 6.64 0 003.03.85A6.7 6.7 0 014.72.75a19 19 0 0013.76 7A7.3 7.3 0 0121.18.89a13.46 13.46 0 004.14 1.57A6.6 6.6 0 0121 6.09a13.42 13.42 0 004-.84c-.26 1.04-.83 1.96-1.59 2.73z"/>
                        </svg>
                    </a>
                </div>
            </section> --}}
        </main>
    </div>
</x-landing-layout>
