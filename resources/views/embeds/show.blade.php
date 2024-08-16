<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Developers') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                {{-- <x-dashboard-title>Developers</x-dashboard-title> --}}
              

            <x-embeds.update-embed-code />

            <x-section-border />
            <x-existing-embed-codes />

        </div>
    </div>
</x-app-layout>
