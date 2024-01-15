<div>
    <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">
       Update Category
      </h3>
    </div>

      @if (session('error'))
        <div class="w-full">
          <h6 class="mb-3 text-lg font-bold text-red dark:text-[#ad0c16]" style="color: red;">
            {{ session('error') }}
          </h6> 
        </div> 
      @endif
    <div class="p-7">     
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Title</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Title" wire:model="title" id="title" required >
              <x-input-error class="mt-2" :messages="$errors->get('title')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Sub Title</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Sub Title" wire:model="sub_title" id="sub_title" required >
              <x-input-error class="mt-2" :messages="$errors->get('sub_title')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Banner Location</label>
            @php $banner = ['Main Banner','Home Middle Small Banner','Home Bottom Banner']; @endphp
            <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="banner_location" id="banner_location" required autofocus autocomplete="banner_location">
              <option value="">Select Banner Location</option>
              @if(isset($banner) && !empty($banner))
                @foreach($banner as $key => $bannerData)
                  <option value="{{$bannerData}}"> {{$bannerData}}</option>
                @endforeach
              @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('banner_location')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Image</label>
              <input type="file" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Select Image" accept="image/*" wire:model.live="image" id="image" >
              <x-input-error class="mt-2" :messages="$errors->get('image')" />
              @if(isset($oldImage) && $oldImage)
                    <div class="mt-2">
                        <p><strong>Preview:</strong></p>
                        <img src="{{ route('displayImage') }}?imagepath={{ $oldImage }}" width="100" height="100">
                    </div>
                @endif
          </div>
        </div>
        
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Link Text</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Link Text" wire:model="link_text" id="link_text" required >
              <x-input-error class="mt-2" :messages="$errors->get('link_text')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Link URL</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Link URL" wire:model="link_url" id="link_url" required >
              <x-input-error class="mt-2" :messages="$errors->get('link_url')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Description</label>
          <textarea name="description" id="description" cols="3" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Description" wire:model="description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Status</label>
            <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="status" id="status" required autofocus autocomplete="status">
              <option  value="">Select Status</option>
              <option  value="1">Active</option>
              <option  value="0">Inactive</option>
            </select>
              <x-input-error class="mt-2" :messages="$errors->get('status')" />
          </div>
        </div>        

        <div class="flex justify-end gap-4.5">
          <button
            class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
            type="button" wire:click="cancel()">
            Cancel
          </button>
          <div wire:loading.remove>
            <button
              class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
              type="button"  wire:click="update()">
              {{$buttonText}} 
            </button>
          </div>
          <div wire:loading>
            <button 
              class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
              type="button">
              Loading.... 
            </button>
          </div>
        </div>
    </div>
</div>