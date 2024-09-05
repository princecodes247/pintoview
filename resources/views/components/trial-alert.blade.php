            @if(!auth()->user()->isSubscriptionActive() && auth()->user()->eligible_for_trial)

 <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md mb-8" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Alert Icon -->
                            <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m0 4h1v-4h-1m-6 8h12m-6-8h0m0-8h.01" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-yellow-700">{{ __('Try Premium for Free!') }}</h3>
                            <p class="text-sm text-yellow-600">
                                {{ __('You are eligible for a free trial of our Premium features. Unlock advanced settings and more by starting your trial today!') }}
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <form method="POST" action="{{ route('subscriptions.start-trial') }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                                    {{ __('Start Free Trial') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
