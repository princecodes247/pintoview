<div x-data="{ showModal: false, id: null, title: '', directLink: '', placement: '', image: '', mobileImage: '', link: '' }">
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Existing Banner Ads') }}
            </x-slot>

            <x-slot name="description">
                {{ __('You may delete or edit any of your existing banner ads if they are no longer needed.') }}
            </x-slot>

            <!-- Banner Ads List -->
            <x-slot name="content">
                @if($bannerAds->isEmpty())
                    <p class="text-white">No banner ads available.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($bannerAds as $bannerAd)
                            <div class="flex items-center flex-wrap justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <div class="break-all dark:text-white">
                                        {{ $bannerAd->title }}
                                    </div>

                                    <div class="break-all text-sm underline dark:text-blue-400">
                                        {{ Str::limit($bannerAd->direct_link, 30, '...') }}
                                    </div>
                                </div>

                                <div class="break-all dark:text-white capitalize">
                                    {{ $bannerAd->placement }}
                                </div>

                                <div class="break-all dark:text-white capitalize flex gap-2">
                                    <img src="{{ $bannerAd->image }}" alt="{{ $bannerAd->title }}" style="max-width: 100px;">
                                    <img src="{{ $bannerAd->mobile_image }}" alt="{{ $bannerAd->title }}" style="max-width: 100px;">
                                </div>

                                <div class="flex space-x-2">
                                    <button 
                                        class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 rounded-md px-3 py-1"
                                        x-on:click="showModal = true; id = {{ $bannerAd->id }}; title = '{{ $bannerAd->title }}'; directLink = '{{ $bannerAd->direct_link }}'; placement = '{{ $bannerAd->placement }}'; image = '{{ $bannerAd->image }}'; mobileImage = '{{ $bannerAd->mobile_image }}'; link = '{{ route('banner-ads.update', $bannerAd->id) }}'"
                                        >
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('banner-ads.destroy', $bannerAd->id) }}">
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
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Edit Banner Ad</h2>
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
                       <x-select id="placement" name="placement" x-model="placement" class="mt-1 block w-full" required :options="[
            ['value' => 'header', 'label' => __('Header')],
            ['value' => 'footer', 'label' => __('Footer')],
        ]" />
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <x-input type="text" name="image" id="image" x-model="image" class="w-full"/>
                </div>
                <div class="mb-4">
                    <label for="mobileImage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mobile Image</label>
                    <x-input type="text" name="mobile_image" x-model="mobileImage" id="mobileImage" class="w-full"/>
                </div>
                <div class="flex justify-end">
                    <button type="button" x-on:click="showModal = false" class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md px-4 py-2 mr-2">Cancel</button>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
