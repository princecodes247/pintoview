<div x-data="{ showModal: false, id: null, title: '', directLink: '', placement: '', link: '' }">
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Existing Button Ads') }}
            </x-slot>

            <x-slot name="description">
                {{ __('You may edit or delete any of your existing button ads if they are no longer needed.') }}
            </x-slot>

            <!-- Button Ads List -->
            <x-slot name="content">
                @if($buttonAds->isEmpty())
                    <p class="text-white">No button ads available.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($buttonAds as $buttonAd)
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $buttonAd->title }}
                                </div>

                                <div class="break-all text-sm underline dark:text-blue-400">
                                    {{ Str::limit($buttonAd->direct_link, 30, '...') }}
                                </div>

                                <div class="break-all dark:text-white capitalize">
                                    {{ $buttonAd->placement }}
                                </div>

                                <div class="flex space-x-2">
                                    <button 
                                        class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 rounded-md px-3 py-1"
                                        x-on:click="showModal = true; id = {{ $buttonAd->id }}; title = `{{ $buttonAd->title }}`; directLink = `{{ $buttonAd->direct_link }}`; placement = '{{ $buttonAd->placement }}'; link = '{{ route('button-ads.update', $buttonAd->id) }}'">
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('button-ads.pause', $buttonAd->id) }}">
                                        @csrf
                                        <button type="submit" class="text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-md px-3 py-1">
                                            {{ $buttonAd->is_paused ? 'Unpause' : 'Pause' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('button-ads.destroy', $buttonAd->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-white bg-red-500 hover:bg-red-600 rounded-md px-3 py-1">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-slot>
        </x-action-section>
    </div>

    <!-- Edit Modal -->
    <div 
        x-show="showModal" 
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50"
        style="display: none;">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Edit Button Ad</h2>
            <form method="POST" x-bind:action="link">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <x-input type="text" name="title" id="title" x-model="title" class="w-full"/>
                </div>
                <div class="mb-4">
                    <label for="directLink" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Direct Link</label>
                    <x-input type="text" name="direct_link" id="directLink" x-model="directLink" class="w-full"/>
                </div>
                <div class="mb-4">
                    <label for="placement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Placement</label>
                      <x-select id="placement" name="placement" class="mt-1 block w-full" x-model="placement" required :options="[
            ['value' => 'top', 'label' => __('Top')],
            ['value' => 'bottom', 'label' => __('Bottom')],
        ]" />
                </div>
                <div class="flex justify-end">
                    <button type="button" x-on:click="showModal = false" class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md px-4 py-2 mr-2">Cancel</button>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
