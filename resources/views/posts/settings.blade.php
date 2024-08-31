<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-section-border />
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Default Post Appearance') }}</h3>
            <form method="POST" action="{{ route('posts.settings.update') }}">
                @csrf

                <x-theme-selector />

                <!-- Show/Hide Post Created Date -->
                <div class="mt-12">
                    <label for="show_date" class="flex items-center">
                        <input type="checkbox" name="show_date" id="show_date" value="1" class="form-checkbox h-5 w-5 text-blue-600" {{ $user->show_date ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-900 dark:text-gray-300">{{ __('Show Post Created Date') }}</span>
                    </label>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2">{{ __('Save Settings') }}</button>
                </div>
            </form>

            <x-section-border />
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Create Post Template') }}</h3>
            <x-posts.update-templates />
            <x-section-border />
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Post Templates') }}</h3>
            <x-existing-templates />
        </div>
    </div>
</x-app-layout>
