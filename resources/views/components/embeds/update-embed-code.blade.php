<x-form-section-base action="{{ route('embeds.store') }}" method="POST">
     <x-slot name="title">
        {{ __('Add Embed Code') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update the embed code for your download page.') }}
    </x-slot>

    <x-slot name="form">
     <div class="col-span-6 sm:col-span-4">

            <x-label for="title" value="{{ __('Title') }}" />
            <x-input id="title" name="title" type="text" class="mt-1 block w-full" required />
            <x-input-error for="title" class="mt-2" />
        </div>

    <div class="col-span-6 sm:col-span-4">
        <x-label for="embed_code" :value="__('Embed Code')" />

        <x-textarea id="embed_code" name="content" class="block mt-1 w-full"/>

        <x-input-error for="embed_code" class="mt-2" />
    </div>
    </x-slot>

    <x-slot name="actions">
    

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section-base>
