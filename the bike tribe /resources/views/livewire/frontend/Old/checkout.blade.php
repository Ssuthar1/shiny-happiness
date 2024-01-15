<div class="container grid grid-cols-12 gap-6 pb-14">
        <div class="col-span-12 md:col-span-6 lg:col-span-8">
            <h4 class="bg-[#E9E4E4] px-3 py-2">Shipping details</h4>
            <div>
                <div class="sm:flex md:block lg:flex gap-6 mt-6">
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2">
                        <label for="shipping_first_name">First Name <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_first_name" wire:model="shipping_first_name">
                        @error('shipping_first_name') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                    </div>
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 mt-6 sm:mt-0 md:mt-6 lg:mt-0">
                        <label for="shipping_last_name">Last Name <span class="text-primary"></span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_last_name" wire:model="shipping_last_name" >
                      
                    </div>
                </div>
                <div class="sm:flex md:block lg:flex gap-6 mt-6">
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2">
                        <label for="shipping_email">Email <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_email" wire:model="shipping_email">
                        @error('shipping_email') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                    </div>
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 mt-6 sm:mt-0 md:mt-6 lg:mt-0">
                        <label for="shipping_mobile">Mobile No <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_mobile" wire:model="shipping_mobile" >
                            @error('shipping_mobile') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                      
                    </div>
                </div>
                  <div class="mt-4">
                    <label for="street_addr">Street Address <span class="text-primary">*</span></label>
                    <input class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                        type="text" id="shipping_mobile" wire:model="shipping_address_line_1" >
                         @error('shipping_address_line_1') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                </div>

                 <div class="sm:flex md:block lg:flex gap-6 mt-6">
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2">
                        <label for="shipping_city">Town/City <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_city" wire:model="shipping_city">
                        @error('shipping_city') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                    </div>
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 mt-6 sm:mt-0 md:mt-6 lg:mt-0">
                        <label for="shipping_state">State <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_state" wire:model="shipping_state" >
                            @error('shipping_state') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                      
                    </div>
                </div>
                 <div class="sm:flex md:block lg:flex gap-6 mt-6">
                    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2">
                        <label for="shipping_postcode">Zip Code <span class="text-primary">*</span></label>
                        <input
                            class="w-full text-sm border border-[#E9E4E4] rounded focus:ring-0 focus:border-primary mt-2"
                            type="text" id="shipping_postcode" wire:model="shipping_postcode">
                        @error('shipping_postcode') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                    </div>
                    
                </div>
           
             
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-4">
            <h4 class="bg-[#E9E4E4] px-3 py-2">Your Order</h4>
            <div class="border border-[#E9E4E4] px-4 py-6 mt-4">
                <h4 class="uppercase border-b border-[#E9E4E4] pb-2">product</h4>
                 @if(count($cartItems)>0)
                    @foreach($cartItems as $cartItem)
                    	@php //$item_total = 0;
                             //$total_quantity = 0;
                         @endphp
		                <div class="flex justify-between mt-5">
		                    <div class="checkorder_cont">
		                        <h5>{{$cartItem->product_name}}</h5>
		                        <p>per {{$cartItem->productInfo->sale_unit}}</p>
		                    </div>
		                    <p class="font-semibold">x{{$cartItem->quantity}}</p>
		                     
		                    <p class="font-semibold">{{$currency}}{{$cartItem->rate}}</p>
		                    @php //$item_total = $cartItem->rate * $cartItem->quantity;
                           // $total_quantity = $total_quantity + $cartItem->quantity;
                             @endphp
	                      	@php //$cartTotal = $cartTotal + $item_total ; @endphp
		                </div>
                	@endforeach
                @endif
                
                
                <div class="flex justify-between border-b pb-3 mt-5">
                    <h5 class="font-semibold uppercase">Subtotal</h5>
                    <p class="font-semibold">{{$currency}}{{number_format($cartTotal,2)}}</p>
                </div>
                <div class="flex justify-between border-b pb-3 mt-5">
                    <h5 class="font-semibold uppercase">Shipping</h5> 
                     @if($deliveryCharge>0) 
                            <p class="font-semibold">{{$currency}}{{number_format($deliveryCharge,2)}}</p>
                            @else
                            <p class="font-semibold">Free</p>
                            @endif
                </div>
                 <div class="flex justify-between border-b pb-3 mt-5">
                    <h5 class="font-semibold uppercase">Tax</h5>
                     
                    @if($taxPer>0)
                           
                            <p class="font-medium">{{$currency}}{{number_format($total_tax,2)}}</p>
                            @else
                            <p class="font-medium">Nil</p>
                            @endif
                </div>
                <div class="flex justify-between border-b pb-3 mt-5">
                	@php $cartGrandTotal = $cartTotal + $deliveryCharge +  $total_tax; @endphp
                    <h5 class="font-semibold uppercase">Total</h5>
                    <p class="font-semibold">{{$currency}}{{number_format($cartGrandTotal,2)}}</p>
                </div>
                <div class="flex gap-3 items-center mt-4">
                    <input type="checkbox"
                        class="focus:ring-0 text-primary border border-primary focus:bg-primary focus:outline-none"
                        id="terms" wire:model.live="terms">
                    <label for="save-default" class="text-sm cursor-pointer">Agree to our
                     <a href="{{route('termsCondition')}}" target="_blank" 
                            class="text-primary">Terms & conditions</a></label>
                          
                </div>
                  @error('terms') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                <div class="mt-4"  >
                    <button class="default_btn w-full" wire:loading.remove wire:click="placeOrder();">place order</button> 
                    <button class="default_btn w-full" wire:loading >Processing...</button> 
                </div>
                
            </div>
        </div>


<div class="hidden">
	<form id="paymentForm" action="{!!route('razorpayPaymentCallBack')!!}" method="POST" >
                        <!-- Note that the amount is in paise = 50 INR -->
                        <!--amount need to be in paisa-->
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ Config::get('global.razor_key') }}"
                                data-amount="{{$cartGrandTotal*100}}"
                                data-buttontext="Place Order"
                                data-name="Fresh Fruits Express"
                                data-description="Order Value"
                                data-image="{{ asset('frontend/') }}/images/logo.png"
                                data-prefill.name="Sikander Singh Shekhawat"
                                data-prefill.email="codermat@gmail.com"
                                data-theme.color="#de0808">
                        </script>
                        <button  class="default_btn w-full">place order</button>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    </form>
</div> 
    </div>