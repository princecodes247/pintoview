  <div class="mt-10 sm:mt-0">
      <x-action-section>
          <x-slot name="title">
              {{ __('Existing Embed Codes') }}
          </x-slot>

          <x-slot name="description">
              {{ __('You may delete any of your existing button ads if they are no longer needed.') }}
          </x-slot>

          <!-- Embed Codes List -->
          <x-slot name="content">
              @if($embedCodes->isEmpty())
              <p class="text-white">No embed codes yet.</p>
              @else
              <div class="space-y-6">
                  @foreach ($embedCodes as $embedCode)
                  <div class="flex items-center justify-between">
                      <div class="break-all dark:text-white">
                          {{ $embedCode->title }}
                      </div>

                      <div class="break-all text-sm dark:text-white">
                          {{ Str::limit($embedCode->content, 100, '...') }}
                      </div>




                          <div class="flex space-x-2">
                            
                              <form method="POST" action="{{ route('embed.destroy', $embedCode->id) }}">
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
