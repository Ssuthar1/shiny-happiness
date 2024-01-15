<div>
  <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
    <h3 class="font-medium text-black dark:text-white">
      {{$buttonText}} Product
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
        <div class="w-full sm:w-1/2 selectTwoCss">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Categories</label>
          <select  class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="product_category" required autofocus autocomplete="product_category">
            <option value="">Select Category</option>
            @if(isset($parentCategory) && !empty($parentCategory))
              @foreach($parentCategory as $key => $categoryValue)
                <option value="{{$categoryValue->id}}"> {{$categoryValue->name}}</option>
              @endforeach
            @endif
          </select>
          <x-input-error class="mt-2" :messages="$errors->get('product_category')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Name</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Name" wire:model="name" id="name" required >
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
      </div>
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Image</label>
            <input type="file" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Select Image" accept="image/*"  wire:model.live="image" id="image" >
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
          for="emailAddress">SKU ID</label>
          
          <div class="relative flex justify-end">
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Select SKU ID" wire:model.live="sku_id" id="sku_id" maxlength="20">
            <span class="absolute top-4 mr-2">
              <a href="javascript:void(0);" wire:click="skuCode()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise h-6 w-6" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
              </svg></a>
            </span> 
          </div>
          <x-input-error class="mt-2" :messages="$errors->get('sku_id')" />
        </div>
      </div> 
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Display Unit</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: gm" wire:model="display_unit" id="display_unit" >
            <x-input-error class="mt-2" :messages="$errors->get('display_unit')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Display Mrp Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: 50" wire:model="display_mrp_price" id="display_mrp_price" >
            <x-input-error class="mt-2" :messages="$errors->get('display_mrp_price')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Display Sale Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: 50" wire:model="display_sale_price" id="display_sale_price" >
            <x-input-error class="mt-2" :messages="$errors->get('display_sale_price')" />
        </div>
      </div>            
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Sale Unit</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: gm" wire:model="sale_unit" id="sale_unit" >
            <x-input-error class="mt-2" :messages="$errors->get('sale_unit')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Sale Mrp Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: 50" wire:model="sale_mrp_price" id="sale_mrp_price" >
            <x-input-error class="mt-2" :messages="$errors->get('sale_mrp_price')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Final Sale Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Eg: 50" wire:model="final_sale_price" id="final_sale_price" >
            <x-input-error class="mt-2" :messages="$errors->get('final_sale_price')" />
        </div>
      </div>                 
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2 mt-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Latest</label>
            <input type="checkbox" class="rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="is_latest" id="is_latest" >
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Best Selling</label>
            <input type="checkbox" class="rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="is_bestselling" id="is_bestselling" >
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Top Rated</label>
            <input type="checkbox" class="rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="is_top_rated" id="is_top_rated" >
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">New Arrival</label>
            <input type="checkbox" class="rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="is_new_arrival" id="is_new_arrival" >
        </div>
      </div>       
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Status</label>
          <select  class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="status" id="status" required autofocus autocomplete="status">
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