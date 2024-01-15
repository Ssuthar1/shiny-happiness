<div>
  @can('view-products-inventory')
  <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
    <h3 class="font-medium text-black dark:text-white">
     @if(isset($buttonText) && $buttonText == 'Update') {{$buttonText}} @else Add @endif Product Inventory
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
          for="emailAddress">Unit Name</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Unit Name" wire:model="unit_name" id="unit_name" required >
            <x-input-error class="mt-2" :messages="$errors->get('unit_name')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Current Stock</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Current Stock" wire:model="current_stock" id="current_stock" required >
            <x-input-error class="mt-2" :messages="$errors->get('current_stock')" />
        </div>
      </div>
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Price" wire:model="price" id="price" required >
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Sale Price</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Sale Price" wire:model="sale_price" id="sale_price" required >
            <x-input-error class="mt-2" :messages="$errors->get('sale_price')" />
        </div>
      </div>
      <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Out Of Stock</label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Out Of Stock" wire:model="out_of_stock" id="out_of_stock" required >
            <x-input-error class="mt-2" :messages="$errors->get('out_of_stock')" />
        </div>
        <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
          for="emailAddress">Custom Message</label>
            <textarea name="custom_message" class="w-full rounded border border-stroke bg-gray py-3 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Custom Message" wire:model="custom_message" id="custom_message" cols="30" rows="3"></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('custom_message')" />
        </div>
      </div>
      <div class="flex justify-end gap-4.5">
        <button
          class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
          type="button" @if(isset($inventoryData) && count($inventoryData)) wire:click="cancelInventory()" @else wire:click="cancel()" @endif>
          Cancel
        </button>
        <div wire:loading.remove>
          <button
            class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
            type="button"  wire:click="saveInventory()">
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
  
  @else
    <p class="mb-5"> Sorry you are not authorize to access this section.</p>
  @endcan
</div>