<div>
  @if(isset($pageType) && $pageType == 'edit')
    @include('livewire.dashboard.settings.create')
  @else
  <div class="max-w-full overflow-x-auto">
      @if (session('success'))
        <div class="w-full">
          <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
            {{ session('success') }}
          </h5> 
        </div> 
      @endif
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gray-2 text-left dark:bg-meta-4">
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Option Name
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
             Option Value
            </th>
            <th class="min-w-[100px] py-4 px-4 font-medium text-black dark:text-white text-end">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          @if(count($data))
            @foreach($data as $depKey => $settingData)
              <tr>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">{{$settingData->option_name ?? ''}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">
                    @if(isset($settingData->option_type) && $settingData->option_type == 'file' && !empty($settingData->option_value)) 
                    <img src="{{ route('displayImage') }}?imagepath={{ $settingData->option_value }}" width="50" height="50"> 
                    @elseif(isset($settingData->option_type) && $settingData->option_type == 'video' && !empty($settingData->option_value))
                    <video width="80" height="80" controls>
                        <source src="{{ route('displayImage') }}?imagepath={{ $settingData->option_value }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @elseif(isset($settingData->option_type) && $settingData->option_type == 'audio' && !empty($settingData->option_value))
                    <audio  width="300" height="200" controls>
                      <source src="{{ route('displayImage') }}?imagepath={{ $settingData->option_value }}" type="audio/mpeg"> 
                    </audio>
                    @elseif($settingData->option_key == 'referral_reward')
                      {{$settingData->option_value}} @if(isset($options['currency'])) {{$options['currency']}}  @endif
                    @elseif($settingData->option_key == 'referral_upline')
                      {{$settingData->option_value}} %
                    @else
                     {{substr($settingData->option_value,0,120)}}
                   @endif</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <div class="flex items-center space-x-3.5">
                    @can('edit-web-settings')
                    <button class="hover:text-primary" wire:click="edit({{$settingData->id}})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </button>
                    @endcan
                  </div>
                </td>
              </tr>
            @endforeach
          @else
          <tr>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark" colspan="5">
              Not record found.
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    <div class="mb-5.5">
      {{$data->links()}}
  </div>
  </div>
  @endif
</div>