 	<div>	
 			@if($location=='desktop')
 				<div class="relative group hidden lg:block py-1.5">
                    <a href="{{route('cart')}}" class="text-white ml-5 relative block text-center">
                        <span class="text-white flex justify-center"><svg width="28" height="28" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M94 216a14 14 0 1 1-14-14a14 14 0 0 1 14 14Zm90-14a14 14 0 1 0 14 14a14 14 0 0 0-14-14Zm43.5-128.4L201.1 166a22.2 22.2 0 0 1-21.2 16H84.1a22.2 22.2 0 0 1-21.2-16L36.5 73.8v-.3l-9.8-34a1.9 1.9 0 0 0-1.9-1.5H8a6 6 0 0 1 0-12h16.8a14.1 14.1 0 0 1 13.5 10.2L46.8 66h174.9a6 6 0 0 1 4.8 2.4a6 6 0 0 1 1 5.2ZM213.8 78H50.2l24.3 84.7a10 10 0 0 0 9.6 7.3h95.8a10 10 0 0 0 9.6-7.3Z" />
                            </svg>
                        </span>
                        <span class="text-white text-[11px] leading-[10px]">Cart</span>
                        <span
                            class="absolute bg-secondary -top-1 -right-2 text-white text-[11px] w-[18px] h-[18px] leading-[18px] text-center rounded-full overflow-hidden" id="topCartItem">{{$total_item}}</span>
                    </a>

                    <div
                        class="absolute top-full right-0 bg-white z-20 p-4 w-[300px] rounded-b-[3px] mt-3.5 group-hover:mt-[5px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        @if(count($cartItems)>0)
                        <div class="mb-3 border-b border-[#d8d8d8]">
                            <h4 class="text-base text-secondary mb-2"> 
                    Total {{$total_item}} Items
                     </h4>
                        </div>
                        @endif 
                        @php $cartTotal = 0; @endphp
                        @if(count($cartItems)>0)
                        <div wire:loading.remove>
                        	@foreach($cartItems as $cartItem)
                            <a href="javascript:void();" class="flex items-start pr-5 mb-4 relative">
                                
                                <span wire:click="removeCartItem('{{$cartItem->id}}')" title="Remove item" alt="Remove item" class="absolute right-0 hover:text-primary transition duration-300"><svg
                                        width="18" height="18" viewBox="0 0 32 32">
                                        <path fill="currentColor"
                                            d="M7.219 5.781L5.78 7.22L14.563 16L5.78 24.781l1.44 1.439L16 17.437l8.781 8.782l1.438-1.438L17.437 16l8.782-8.781L24.78 5.78L16 14.563z" />
                                    </svg></span>
                                
                                <div class="flex-shrink-0">
                                    @if(isset($cartItem->productInfo->image))
                                    <img src="{{ route('displayImage') }}?imagepath={{$cartItem->productInfo->image}}" class="w-[75px] h-[60px] object-contain"
                                        alt="{{$cartItem->product_name}}" title="{{$cartItem->product_name}}">
                                    @endif
                                </div>

                                <div class="flex-grow pl-4">
                                    <h5 class="text-base text-secondary hover:text-primary transition duration-300">
                                       {{$cartItem->product_name}}
                                    </h5>
                                    <p class="text-[#464545] text-sm">x{{$cartItem->quantity}} <span class="ms-2">{{$cartItem->rate}}</span></p>
                                      @php $cartTotal = $cartTotal + ($cartItem->quantity *$cartItem->rate) ; @endphp
                                </div>
                            </a>
                            @endforeach  
                        </div>
                        <div wire:loading> Loading, please wait...
                        </div>
                        @else
                        <div >
                            <h4 class="text-base text-secondary mb-2">No Item in Cart</h4>
                        </div>
                        @endif

                        <div class="mt-4 pt-4 border-t border-[#d8d8d8] flex justify-between">
                            <h4 class="text-base text-secondary">SUB TOTAL:</h4>
                            <h4 class="text-base ml-2">{{$currency}}{{number_format($cartTotal,2)}}</h4>
                        </div>
                        <div class="flex mt-4 gap-4">
                            <a href="{{route('cart')}}"
                                class="w-1/2 rounded-[3px] py-2 px-2.5 border border-primary bg-primary text-white inline-block text-center text-sm hover:bg-transparent hover:text-primary transition duration-300">VIEW
                                CART</a>
                            <a href="{{route('checkout')}}"
                                class="w-1/2 rounded-[3px] py-2 px-2.5 border border-primary hover:bg-primary bg-white hover:text-white inline-block text-center text-sm text-primary transition duration-300">CHECKOUT</a>
                        </div>
                    </div>
                </div>
            @elseif($location=='mobile')

             <div class="p-4 flex-grow flex flex-col">
                <div class="mb-3 border-b border-[#d8d8d8]">
                    <h4 class="text-base mb-1.5 font-medium text-secondary">
                    @if(count($cartItems)>0)
                    Total {{$total_item}}
                    @else
                    No 
                    @endif
                     Items</h4>
                </div>
                @if(count($cartItems)>0)
                 @php $cartTotal = 0; @endphp
                <div wire:loading.remove>
                	@foreach($cartItems as $cartItem)
                    <a href="javascript:void();" class="flex relative pr-5 mb-4">
                        <span wire:click="removeCartItem('{{$cartItem->id}}')" title="Remove item" alt="Remove item"
                            class="absolute right-0 cursor-pointer text-secondary hover:text-primary transition duration-300">
                            <svg width="16" height="16" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="M7.219 5.781L5.78 7.22L14.563 16L5.78 24.781l1.44 1.439L16 17.437l8.781 8.782l1.438-1.438L17.437 16l8.782-8.781L24.78 5.78L16 14.563z" />
                            </svg>
                        </span>
                        <div class="flex-shrink-0">
                             @if(isset($cartItem->productInfo->image))
                            <img src="{{ route('displayImage') }}?imagepath={{$cartItem->productInfo->image}}" class="w-[75px] h-[60px] object-contain" alt="{{$cartItem->product_name}}" title=" {{$cartItem->product_name}}">
                            @endif
                        </div>
                        <div class="flex-grow pl-4">
                            <h5 class="text-base text-secondary font-medium hover:text-primary transition duration-300">
                                 {{$cartItem->product_name}}
                            </h5>
                            <p class="text-sm text-[#464545]">x{{$cartItem->quantity}} <span class="ml-2 text-sm text-[#464545]">{{$currency}}{{$cartItem->rate}}</span>
                                 @php $cartTotal = $cartTotal + ($cartItem->quantity *$cartItem->rate) ; @endphp
                            </p>
                        </div>
                    </a>
                    @endforeach
                    
                </div>
                @endif

                <div class="mt-auto">
                    <div class="mt-4 pt-4 border-t border-[#d8d8d8] flex justify-between">
                        <h4 class="text-base font-medium text-secondary">SUB TOTAL:</h4>
                        <h4 class="text-base font-medium text-secondary">{{$currency}}{{number_format($cartTotal,2)}}</h4>
                    </div>
                    <div class="mt-4 flex gap-4">
                        <a href="{{route('cart')}}" class="primary-btn px-2 py-[9px] w-1/2 text-sm">VIEW CART</a>
                        <a href="{{route('checkout')}}"
                            class="primary-btn px-2 py-[9px] w-1/2 bg-white hover:bg-primary text-primary hover:text-white text-sm">CHECKOUT</a>
                    </div>
                </div>
            </div>
            @endif
    </div>