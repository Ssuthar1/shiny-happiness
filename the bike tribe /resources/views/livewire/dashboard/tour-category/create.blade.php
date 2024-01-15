<div>
    <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">
       {{ucfirst($mode)}}  {{$module_title}}
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
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Title" wire:model.defer="title" id="title" required >
              <x-input-error class="mt-2" :messages="$errors->get('title')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Meta Title</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Meta Title" wire:model.defer="meta_title" id="meta_title" required >
              <x-input-error class="mt-2" :messages="$errors->get('meta_title')" />
          </div>
        </div> 
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Meta tag keywords</label>
              <textarea name="meta_tag_keywords" id="meta_tag_keywords" cols="3" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Meta tag keywords" wire:model.defer="meta_tag_keywords"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('meta_tag_keywords')" /> 
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Meta tag description</label>
             <textarea name="meta_tag_keywords" id="meta_tag_keywords" cols="3" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Meta tag description" wire:model.defer="meta_tag_keywords"></textarea>
             <x-input-error class="mt-2" :messages="$errors->get('meta_tag_keywords')" /> 
          </div>
        </div>
		<div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Short Description</label>
              <textarea name="short_description" id="short_description" cols="3" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Short Description" wire:model.defer="short_description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('short_description')" /> 
          </div>
     
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1" wire:ignore>
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Description</label>
              <textarea name="description" id="description" cols="3" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary editor" placeholder="Description" wire:model.defer="description"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" /> 
          </div>
     
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2"> 
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Image</label>
              <input type="file" class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Select Image" accept="photo/*" wire:model.live="photo" id="photo" >
              <x-input-error class="mt-2" :messages="$errors->get('photo')" />
              	 @if (isset($photo) && !empty($photo))
                Photo Preview:
                  <img src="{{ $photo->temporaryUrl() }}" width="100" height="100">
                @elseif(!empty($featured_image_url))
                Photo Preview:
                  <img src="{{ route('displayImage') }}?imagepath={{ $featured_image_url }}" width="100" height="100">
                @endif
                @error('photo') <div class="flex font-medium text-red-600">{{ $message }}</div>@enderror

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
            for="emailAddress">Status</label>
            <select  class="w-full rounded border border-stroke bg-gray py-3 pl-3 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="status" id="status" required autofocus autocomplete="status">
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
          	@if(!empty($tour_category_id))
          	<button
              class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
              type="button" wire:click="update()"   >
              Update Info 
            </button>

          	@else
            <button
              class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
              type="button"    wire:click="store()"  >
              Save Info 
            </button>
            @endif
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