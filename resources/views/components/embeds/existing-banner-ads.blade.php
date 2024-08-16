  <div class="mt-10 sm:mt-0">
      <x-action-section>
          <x-slot name="title">
              {{ __('Existing Banner Ads') }}
          </x-slot>

          <x-slot name="description">
              {{ __('You may delete any of your existing banner ads if they are no longer needed.') }}
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

                       <div class="break-all dark:text-white capitalize">

                      </div>


                      <div class="flex space-x-2">
                   
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
