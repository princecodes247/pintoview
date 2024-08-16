  <div class="mt-10 sm:mt-0">
      <x-action-section>
          <x-slot name="title">
              {{ __('Existing Button Ads') }}
          </x-slot>

          <x-slot name="description">
              {{ __('You may delete any of your existing button ads if they are no longer needed.') }}
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
