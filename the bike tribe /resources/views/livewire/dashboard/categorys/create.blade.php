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
            for="emailAddress">Parent Category</label>
            <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="parent_id" id="parent_id" required autofocus autocomplete="parent_id">
              <option value="">Select Category</option>
              @if(isset($parentCategory) && !empty($parentCategory))
                @foreach($parentCategory as $key => $categoryValue)
                  <option value="{{$categoryValue->id}}"> {{$categoryValue->name}}</option>
                @endforeach
              @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('parent_id')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Name</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Name" wire:model="name" id="name" required >
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
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