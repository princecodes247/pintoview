<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Display Error Messages -->
            @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
            @endif

            <!-- Display Success Messages -->
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
            @endif

            <x-trial-alert />


            <!-- Subscription Card -->
            @if(!auth()->user()->isSubscriptionActive())

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Upgrade to Premium') }}</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Unlock the full potential of our platform by upgrading to a premium subscription. Enjoy exclusive features designed to enhance your experience.') }}
                </p>

                <!-- List of Features for Premium Users -->
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 mb-6 space-y-2">
                    <li>{{ __('Access to premium themes and customization options') }}</li>
                    <li>{{ __('Unlimited Pages') }}</li>
                    <li>{{ __('Custom shortlink') }}</li>
                    <li>{{ __('Ad placement') }}</li>
                    <li>{{ __('Early access to new features') }}</li>
                    <li>{{ __('Priority customer support') }}</li>
                </ul>

                <!-- Payment Button -->
                <form method="POST" action="{{ route('subscriptions.store') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="hidden" name="amount" value="100000"> {{-- Amount in kobo --}}
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg w-full">
                        {{ __('Subscribe Now for ₦1,000') }}
                    </button>
                </form>
            </div>
            @endif
            <!-- Subscription History Section -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Subscription History') }}</h3>
                @if($subscriptions->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('You have no previous subscriptions.') }}
                </p>
                @else
                <ul class="space-y-4">
                    @foreach($subscriptions as $subscription)
                    <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                        <div>
                            <p class="text-gray-900 dark:text-white font-semibold">{{ $subscription->plan_name }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                {{ __('Subscribed on: ') }}{{ $subscription->created_at->format('M d, Y') }}<br>
                                @if(!$subscription->isActive())
                                <span class="text-red-500">{{ __('(Expired)') }}</span>
                                @else
                                {{ __('Expires at: ') }}{{ $subscription->ends_at->format('M d, Y') }}
                                @endif
                            </p>
                        </div>
                        <p class="text-gray-900 dark:text-white font-semibold">
                            ₦{{ number_format($subscription->amount / 100, 2) }}
                        </p>
                        @if($subscription->isActive())
                        <form method="POST" action="{{ route('subscriptions.cancel', ['subscription' => $subscription]) }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600 underline font-semibold py-3 px-6 rounded-lg w-full">
                                {{ __('Cancel') }}
                            </button>
                        </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
