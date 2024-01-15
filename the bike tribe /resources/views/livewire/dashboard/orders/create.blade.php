<div>
  <div class="flex justify-end gap-4.5"> 
    <button
      class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90 mb-5"
      type="button" wire:click="cancel()">
      Back
    </button>
  </div> 
    <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">
       Order Detail
      </h3>
    </div>
    <div class="mb-5.5gap-5.5" style="display: flex;justify-content: space-around;">
      @php
        $billingAddress = json_decode($orderInfo->billing_address);
        $shippingAddress = json_decode($orderInfo->shipping_address);
      @endphp
      <div class="col-md-4 mt-4">
        <div class="form-group">
          <label>Billing Address :&nbsp; </label>  
          <div>

          </div>
        </div>
      </div>
      
      <div class="col-md-4 mt-4">
        <div class="form-group">
          <label> Shipping Address :&nbsp; </label>  
          <div>

          </div>
        </div>
     </div>
    </div>
    
    <div class="mt-4">
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gray-2 text-left dark:bg-meta-4">
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Product
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Quantity
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Total Price
            </th>
          </tr>
        </thead>
        <tbody>
          @if(count($orderInfo->getOrderItems))
          @php $i = 1; @endphp
            @foreach($orderInfo->getOrderItems as $depKey => $orderDetail)
              <tr>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <div class="flex">
                    <div>
                      @if(isset($orderDetail->productInfo) && $orderDetail->productInfo->image)
                        <img src="{{ route('displayImage') }}?imagepath={{ $orderDetail->productInfo->image }}" width="200" height="200">
                      @endif
                    </div>
                    <div>
                      <p class="text-black dark:text-white ml-4">{{$orderDetail->product_name ?? ''}}</p>
                      <p class="text-black dark:text-white ml-4">{{$orderDetail->total ?? ''}}</p>
                      <p class="text-black dark:text-white ml-4">{{$orderDetail->inventory_name ?? ''}}</p>
                    </div>
                  </div>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">{{$orderDetail->quantity ?? ''}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$orderDetail->total ?? ''}}</p>
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
    </div>
</div>