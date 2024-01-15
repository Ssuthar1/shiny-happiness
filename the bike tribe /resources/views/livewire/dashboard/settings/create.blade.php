<div>
    <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">
       Update Setting
      </h3>
    </div>
    <div class="p-7">                   
        <div class="mb-5.5">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">{{$option_name ?? ''}}</label>

            @if(isset($option_type) && $option_type == 'select')
              <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="option_value" id="status" required autofocus autocomplete="status">
                <option>Select {{$option_name ?? ''}}</option>
                @if(isset($special_option) && !empty($special_option))
                  @foreach($special_option as $selectVlaue)
                    <option value="{{$selectVlaue}}"> {{$selectVlaue}}</option>
                  @endforeach
                @endif
              </select>
            @elseif(isset($option_type) && $option_type == 'radio')
                @if(isset($special_option) && !empty($special_option))
                  @foreach($special_option as $selectVlaue)
                    <div class="relative pt-0.5 flex">
                      <input type="radio" wire:model.live="option_value" value="{{$selectVlaue}}" class="rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary mr-2 ">
                      <span> {{$selectVlaue}}</span>
                    </div>
                  @endforeach
                @endif
            @elseif(isset($option_type) && $option_type == 'video')
                <input  class="w-full rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary mb-3" id="duration" wire:model.live="option_value" placeholder="{{$option_name ?? ''}}"  type="file"  accept="video/*" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('option_value')" />
                @if(isset($option_type) && $option_type == 'video')
                  @if(isset($option_type_file) && !empty($option_type_file))
                    <video width="300" height="200" controls>
                        <source src="{{ route('displayImage') }}?imagepath={{ $option_type_file }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                  @endif
                @endif
            @elseif(isset($option_type) && $option_type == 'audio')
                <input  class="w-full rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary mb-3" id="duration" wire:model.live="option_value" placeholder="{{$option_name ?? ''}}"  type="file"  accept="audio/*"  required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('option_value')"/>
                @if(isset($option_type) && $option_type == 'audio')
                  @if(isset($option_type_file) && !empty($option_type_file))
                    <audio  width="300" height="200" controls>
                      <source src="{{ route('displayImage') }}?imagepath={{ $option_type_file }}" type="audio/mpeg"> 
                    </audio>
                  @endif
                @endif
            @elseif(isset($option_type) && $option_type == 'checkbox')
                @if(isset($special_option) && !empty($special_option))
                  @foreach($special_option as $selectVlaue)
                    <div class="relative pt-0.5 flex">
                      <input type="checkbox" id="formCheckbox" wire:model.live="checkBoxValues"  value="{{$selectVlaue}}" class="rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary mr-2">
                      <span> {{$selectVlaue}}</span>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('checkBoxValues')" />
                  @endforeach
                @endif
            @elseif(isset($option_type) && $option_type == 'textarea')
              <textarea class="w-full rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
               id="duration" wire:model.live="option_value" placeholder="{{$option_name ?? ''}}"></textarea>
            @else
              <input  class="w-full rounded border border-stroke bg-gray py-3 px-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
               id="duration" wire:model.live="option_value" placeholder="{{$option_name ?? ''}}"  type="{{$option_type}}"  required autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('option_value')" />
              @if(isset($option_type) && $option_type == 'file')
                @if(isset($option_type_file) && !empty($option_type_file))
                  <img src="{{ route('displayImage') }}?imagepath={{ $option_type_file }}" width="100" height="100">
                @endif
              @endif
            @endif
        </div> 
        <div class="flex justify-end gap-4.5">
          <button
            class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
            type="button" wire:click="cancel()">
            Cancel
          </button>
          <button
            class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
            type="button" wire:click="update()">
            Update 
          </button>
        </div>
    </div>
</div>