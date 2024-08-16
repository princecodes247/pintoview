<x-form-section-base action="{{ route('banner-ads.store') }}" method="POST">
    <x-slot name="title">
        {{ __('Banner Ads') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add banner ads to your page.') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">

            <x-label for="title" value="{{ __('Title') }}" />
            <x-input id="title" name="title" type="text" class="mt-1 block w-full" required />
            <x-input-error for="title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">

            <x-label for="direct_link" value="{{ __('Direct Link') }}" />
            <x-input id="direct_link" name="direct_link" type="url" class="mt-1 block w-full" required />
            <x-input-error for="direct_link" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">

            <x-label for="placement" value="{{ __('Placement') }}" />
            <x-select id="placement" name="placement" class="mt-1 block w-full" required :options="[
            ['value' => 'header', 'label' => __('Header')],
            ['value' => 'footer', 'label' => __('Footer')],
        ]" />
            <x-input-error for="placement" class="mt-2" />
        </div>

          <div class="col-span-6 sm:col-span-4">

            <x-label for="image" value="{{ __('Image URL') }}" />
            <x-input id="image" name="image" type="url" class="mt-1 block w-full" required />
            <x-input-error for="image" class="mt-2" />
        </div>

          <div class="col-span-6 sm:col-span-4">

            <x-label for="mobile_image" value="{{ __('Mobile Image URL') }}" />
            <x-input id="mobile_image" name="mobile_image" type="url" class="mt-1 block w-full" required />
            <x-input-error for="mobile_image" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">


        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section-base>
