<div class="col-span-1 overflow-hidden rounded-[3px] shadow-sm group">
    <div class="relative">
        @if(isset($products->image))
            <img src="{{ route('displayImage') }}?imagepath={{ $products->image }}" class="w-full object-cover flex-shrink-0" alt="{{$products->name}}" title="{{$products->name}}"> 
        @endif
        @if(isset($products->is_new_arrival) && !empty($products->is_new_arrival) && $products->is_new_arrival == '1')
            <div class="absolute top-[15px] left-[15px] p-2 rounded-[3px] bg-[#dc3545] text-[15px] text-white leading-[18px] z-10">New</div>
        @endif
        <!-- <div class="w-[30px] h-[30px] bg-white text-base shadow-sm rounded-full absolute top-[15px] right-[15px] z-10 text-primary flex items-center justify-center cursor-pointer">
            <svg width="26" height="26" viewBox="0 0 50 50">
                <path fill="currentColor"
                    d="m25 39.7l-.6-.5C11.5 28.7 8 25 8 19c0-5 4-9 9-9c4.1 0 6.4 2.3 8 4.1c1.6-1.8 3.9-4.1 8-4.1c5 0 9 4 9 9c0 6-3.5 9.7-16.4 20.2l-.6.5zM17 12c-3.9 0-7 3.1-7 7c0 5.1 3.2 8.5 15 18.1c11.8-9.6 15-13 15-18.1c0-3.9-3.1-7-7-7c-3.5 0-5.4 2.1-6.9 3.8L25 17.1l-1.1-1.3C22.4 14.1 20.5 12 17 12z" />
            </svg>
        </div> -->
        
    </div>
    <div class="p-4">
        <a href="#">
            <h4 class="text-lg leading-6 mb-1 text-secondary hover:text-primary font-medium transition duration-200">
                {{$products->name ?? ''}}</h4>
        </a>
        <p class="text-[15px] text-[#464545] mb-2.5">@if(isset($products->display_mrp_price) && !empty($products->display_mrp_price)) <span class="text-[#fd3d57] " style="text-decoration: line-through;">{{$currency}} {{number_format($products->display_mrp_price , 2) ?? '0'}}</span> @endif {{$currency}} {{number_format($products->display_sale_price , 2) ?? '0'}}/{{$products->display_unit ?? ''}}</p>

        <div class="mr-[5px]">
            <span class="text-xl font-semibold leading-[22px]">
               {{$currency}} {{number_format($products->final_sale_price , 2) ?? '0'}} 
            </span>
            /{{$products->sale_unit ?? ''}}

        </div>
         
    </div>
<!--     <div class="w-full  w-full rounded-t-none text-base leading-[19px] gap-1.5 p-2 rounded-b-[3px] flex items-center justify-center transition-all duration-500"> 
       <div x-data="{number:4}" class="w-full cart_qnty ms-md-auto  flex items-center "> 
                    <div x-data="{count:0}" x-modelable="count" x-model="number"
                        class="flex items-center  mt-1">
                        <div @click="count--"
                            class="w-8 h-8 border hover:bg-[#E9E4E4] flex justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 12.998H5v-2h14z" /></svg>
                        </div>
                        <div x-text="number" class="w-8 h-8 border flex justify-center items-center">4</div>
                        <div @click="count++"
                            class="w-8 h-8 border hover:bg-[#E9E4E4] flex justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                            </svg>
                        </div>
                    </div>
                </div>
          </div>  -->         
    <div class="w-full">  
       <button wire:loading.remove
            class="primary-btn w-full rounded-t-none text-base leading-[19px] gap-1.5 p-2 rounded-b-[3px] flex items-center justify-center transition-all duration-500" wire:click="addToCart()">
            <span class="text-white btn-icon transition duration-500"><svg width="16"
                    height="16" viewBox="0 0 32 32">
                    <circle cx="10" cy="28" r="2" fill="currentColor" />
                    <circle cx="24" cy="28" r="2" fill="currentColor" />
                    <path fill="currentColor"
                        d="M28 7H5.82L5 2.8A1 1 0 0 0 4 2H0v2h3.18L7 23.2a1 1 0 0 0 1 .8h18v-2H8.82L8 18h18a1 1 0 0 0 1-.78l2-9A1 1 0 0 0 28 7Zm-2.8 9H7.62l-1.4-7h20.53Z" />
                </svg></span>
            ADD TO CART
        </button> 
        <button wire:loading
            class="primary-btn w-full rounded-t-none text-base leading-[19px] gap-1.5 p-2 rounded-b-[3px] flex items-center justify-center transition-all duration-500" >
          
            Wait...
        </button>   

    </div>
</div>