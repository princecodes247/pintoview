<x-form-section-base action="{{ route('button-ads.store') }}" method="POST">
    <x-slot name="title">
        {{ __('Button Ads') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add button ads to your page.') }}
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
            ['value' => 'top', 'label' => __('Top')],
            ['value' => 'bottom', 'label' => __('Bottom')],
        ]" />
        <x-input-error for="placement" class="mt-2" />
    </div>

    </x-slot>

    <x-slot name="actions">


        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section-base>
