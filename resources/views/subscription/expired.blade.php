
<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m6.938-2.938A9 9 0 1112 3v0a9 9 0 016.938 15.938z"></path>
                    </svg>
                </div>
                {{-- <h1 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-4">{{ __('Subscription Expired') }}</h1> --}}
                {{-- <p class="text-gray-600 dark:text-gray-300 text-center mb-6">
                    {{ __('Your subscription has expired. To continue enjoying our premium features, please renew your subscription.') }}
                </p> --}}
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-4">{{ __('Oh Oh.') }}</h1>
                <p class="text-gray-600 dark:text-gray-300 text-center mb-6">
                    {{ __('There has been a technical error with this page, kindly contact the owner ') }} <strong>{{ auth()->user()->name }}</strong>{{ __('. If you own this page, check your account and subscription status.') }}
                </p>
                {{-- <div class="text-center">
                    <a href="{{ route('subscription.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg">
                        {{ __('Renew Subscription') }}
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</x-guest-layout>
