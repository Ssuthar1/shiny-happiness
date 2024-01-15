<div class="container pb-10">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-9">
                <div class="hidden lg:flex justify-between bg-[#E9E4E4] py-2">
                    <p class="pl-44 font-semibold">Product</p>
                    <div class="flex gap-24">
                        <span class="font-semibold">Quantity</span>
                        <span class="pr-24 font-semibold">Total Price</span>
                    </div>
                </div>
                <div  class="sm:px-20 md:px-0">
                      @if(count($cartItems)>0)
                    @foreach($cartItems as $cartItem)
                    @php $item_total = 0; @endphp
                    <div class="border md:flex gap-24 lg:gap-28 items-center py-2 mt-6">
                        <div class="md:flex items-center">
                            <div class="max-w-[150px] flex mx-auto">
                                @if(isset($cartItem->productInfo->image))
                                <img loading="lazy" src="{{ route('displayImage') }}?imagepath={{$cartItem->productInfo->image}}" alt="{{$cartItem->product_name}}" title="{{$cartItem->product_name}}">
                                @endif
                            </div>
                            <div class="pl-10 lg:pl-0">
                                <a href="javascript:void('0')">
                                    <h5>{{$cartItem->product_name}}</h5>
                                </a>
                                <p class="text-primary font-medium">{{$currency}}{{$cartItem->rate}}</p>
                                <p class="size mb-0">per {{$cartItem->productInfo->sale_unit}} </p>
                            </div>
                        </div>
                        <div class="flex justify-center gap-20 lg:gap-24 items-center">
                            <!-- quantity -->
                            <div class="flex">
                                <div wire:click="setQuantity('remove','{{$cartItem->product_id}}','{{$cartItem->quantity}}')"
                                    class="border w-8 h-8 flex justify-center items-center hover:bg-[#dadada] cursor-pointer">
                                    <svg width="12" height="12" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 12.998H5v-2h14z" /></svg>
                                </div>
                                <div class="border w-8 h-8 flex justify-center items-center">{{$cartItem->quantity}}</div>
                                <div wire:click="setQuantity('add','{{$cartItem->product_id}}','{{$cartItem->quantity}}')"
                                    class="border w-8 h-8 flex justify-center items-center hover:bg-[#dadada] cursor-pointer">
                                    <svg width="12" height="12" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex gap-12 lg:gap-16">
                                @php $item_total = $cartItem->rate * $cartItem->quantity; @endphp
                                <p class="text-primary font-semibold">{{$currency}}{{number_format($item_total,2)}}</p>
                                @php $cartTotal = $cartTotal + $item_total ; @endphp
                                <div wire:click="removeItem('{{$cartItem->id}}')" class="hover:text-primary cursor-pointer">
                                    <svg width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6q-.425 0-.713-.287Q4 5.425 4 5t.287-.713Q4.575 4 5 4h4q0-.425.288-.713Q9.575 3 10 3h4q.425 0 .713.287Q15 3.575 15 4h4q.425 0 .712.287Q20 4.575 20 5t-.288.713Q19.425 6 19 6v13q0 .825-.587 1.413Q17.825 21 17 21ZM7 6v13h10V6Zm2 10q0 .425.288.712Q9.575 17 10 17t.713-.288Q11 16.425 11 16V9q0-.425-.287-.713Q10.425 8 10 8t-.712.287Q9 8.575 9 9Zm4 0q0 .425.288.712q.287.288.712.288t.713-.288Q15 16.425 15 16V9q0-.425-.287-.713Q14.425 8 14 8t-.712.287Q13 8.575 13 9ZM7 6v13V6Z" />
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>
                     @endforeach 
                     @else
                     <div class="border md:flex gap-24 lg:gap-28 items-center py-2 mt-6 px-2">
                       
                        No Item in Cart

                     </div>
                     @endif 
                     
                </div>
               
            </div>
            <div class="col-span-12 lg:col-span-3 border p-4">
                <div>
                    <h4 class="uppercase text-lg">Order Summary</h4>
                    <div class="space-y-2 border-b pb-3 mt-2">
                        <div class="flex justify-between">
                            <p class="font-medium">Subtotal</p>
                            <p class="font-medium">{{$currency}}{{number_format($cartTotal,2)}}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="font-medium">Delivery</p>
                            @if($deliveryCharge>0) 
                            <p class="font-medium">{{$currency}}{{number_format($deliveryCharge,2)}}</p>
                            @else
                            <p class="font-medium">Free</p>
                            @endif
                        </div>
                        <div class="flex justify-between">
                            <p class="font-medium">Tax</p>
                           @if($taxPer>0)
                           @php $total_tax = ($cartTotal/100)*$taxPer; @endphp
                            <p class="font-medium">{{$currency}}{{number_format($total_tax,2)}}</p>
                            @else
                            <p class="font-medium">Nil</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <p class="font-semibold">Total</p>
                        @php $cartGrandTotal = $cartTotal + $deliveryCharge +  $total_tax; @endphp
                        <p class="font-semibold">{{$currency}}{{number_format($cartGrandTotal,2)}}</p>
                    </div>
                    <div class="flex hidden  w-full lg:max-w-sm rounded-lg overflow-hidden mt-4">
                        <input type="text" placeholder="Enter coupon"
                            class="w-full border border-[#E9E4E4] text-xs focus:outline-none  focus:border-primary overflow-hidden">
                        <button
                            class="bg-primary border border-primary text-white rounded-br-lg text-xs uppercase px-4 sm:px-8 lg:px-4 hover:bg-white hover:text-primary hover:border-primary transition-all ">apply</button>
                    </div>
                    <div class="mt-8">
                        <a href="{{route('checkout')}}"
                            class="block w-full px-8 lg:px-2 xl:px-8 py-2 text-center bg-primary hover:bg-transparent text-white hover:text-primary hover:border-primary border transition duration-300 rounded-lg uppercase text-sm">Proceed
                            to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>