<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
               <x-trial-alert/>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-section-border />
            @endif

            <x-form-section-base action="{{ route('profile.update') }}" method="POST">

                <x-slot name="title">
                    {{ __('Social Links') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add social links to your profile page.') }}
                </x-slot>
                <x-slot name="form">

                    <!-- Social Links -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="facebook" value="{{ __('Facebook') }}" />
                        <x-input id="facebook" type="url" class="mt-1 block w-full" name="facebook" value="{{ old('facebook', $user->facebook) }}" placeholder="https://facebook.com/username" />
                        <x-input-error for="facebook" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="twitter" value="{{ __('Twitter') }}" />
                        <x-input id="twitter" type="url" class="mt-1 block w-full" name="twitter" value="{{ old('twitter', $user->twitter) }}" placeholder="https://twitter.com/username" />
                        <x-input-error for="twitter" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="whatsapp" value="{{ __('WhatsApp') }}" />
                        <x-input id="whatsapp" type="url" class="mt-1 block w-full" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" placeholder="https://wa.me/phone_number" />
                        <x-input-error for="whatsapp" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="telegram" value="{{ __('Telegram') }}" />
                        <x-input id="telegram" type="url" class="mt-1 block w-full" name="telegram" value="{{ old('telegram', $user->telegram) }}" placeholder="https://t.me/username" />
                        <x-input-error for="telegram" class="mt-2" />
                    </div>

                    <!-- Custom Domain -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="custom_domain" value="{{ __('Custom Domain') }}" />
                        <x-input id="custom_domain" type="url" class="mt-1 block w-full" name="custom_domain" value="{{ old('custom_domain', $user->custom_domain) }}" placeholder="https://yourcustomdomain.com" />
                        <x-input-error for="custom_domain" class="mt-2" />
                        <small class="text-gray-500">{{ __('Redirect app.com/username to your custom domain.') }}</small>
                    </div>



                </x-slot>
                <x-slot name="actions">



                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-button>
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </x-slot>
            </x-form-section-base>
            <x-section-border />


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
