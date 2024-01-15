<div x-data class="container pb-14">
        <h2 class="text-[28px] text-secondary mb-6">{{$title}}</h2>
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            	@if(isset($productList) && count($productList))
                  	@foreach($productList as $products) 
		                <div class="swiper-slide">
		                    <div class="overflow-hidden rounded-[3px] shadow-sm group">
		                        <div class="relative">
	                        	 	@if(isset($products->image))
		                            <img src="{{ route('displayImage') }}?imagepath={{ $products->image }}" class="w-full object-cover flex-shrink-0"
		                                 alt="{{$products->name}}" title="{{$products->name}}">
	                                @endif
	                                @if($type=='top_rated')
		                            <div
		                                class="absolute top-[15px] left-[15px] p-2 rounded-[3px] bg-[#28A745] text-[15px] text-white leading-[18px] z-10">
		                                Top</div>
		                                @elseif($type=='new_arrivals')
		                                 <div
		                                class="absolute top-[15px] left-[15px] p-2 rounded-[3px] bg-[#dc3545] text-[15px] text-white leading-[18px] z-10">
		                                Hot</div>
		                                @elseif($type=='best_selling')
		                                 <div
		                                class="absolute top-[15px] left-[15px] p-2 rounded-[3px] bg-[#ffc107] text-[15px] text-white leading-[18px] z-10">
		                                Best</div>
		                                 
		                                @endif

		                            <!-- <div
		                                class="w-[30px] h-[30px] bg-white text-base shadow-sm rounded-full absolute top-[15px] right-[15px] z-10 text-primary flex items-center justify-center cursor-pointer">
		                                <svg width="26" height="26" viewBox="0 0 50 50">
		                                    <path fill="currentColor"
		                                        d="m25 39.7l-.6-.5C11.5 28.7 8 25 8 19c0-5 4-9 9-9c4.1 0 6.4 2.3 8 4.1c1.6-1.8 3.9-4.1 8-4.1c5 0 9 4 9 9c0 6-3.5 9.7-16.4 20.2l-.6.5zM17 12c-3.9 0-7 3.1-7 7c0 5.1 3.2 8.5 15 18.1c11.8-9.6 15-13 15-18.1c0-3.9-3.1-7-7-7c-3.5 0-5.4 2.1-6.9 3.8L25 17.1l-1.1-1.3C22.4 14.1 20.5 12 17 12z" />
		                                </svg>
		                            </div> -->
		                           <!--  <div
		                                class="w-full h-full absolute left-0 top-0 bg-bgcolor opacity-0 group-hover:opacity-100 transition-all duration-500">
		                                <button @click="$store.productView.isActive=true"
		                                    class="absolute left-0 bottom-0 w-full p-2 bg-secondary text-white text-base text-center leading-4 flex items-center justify-center">
		                                    <span class="text-white mr-1"><svg width="20" height="20" viewBox="0 0 32 32">
		                                            <path fill="currentColor"
		                                                d="M16 8C7.664 8 1.25 15.344 1.25 15.344L.656 16l.594.656s5.848 6.668 13.625 7.282c.371.046.742.062 1.125.062s.754-.016 1.125-.063c7.777-.613 13.625-7.28 13.625-7.28l.594-.657l-.594-.656S24.336 8 16 8zm0 2c2.203 0 4.234.602 6 1.406A6.89 6.89 0 0 1 23 15a6.995 6.995 0 0 1-6.219 6.969c-.02.004-.043-.004-.062 0c-.239.011-.477.031-.719.031c-.266 0-.523-.016-.781-.031A6.995 6.995 0 0 1 9 15c0-1.305.352-2.52.969-3.563h-.031C11.717 10.617 13.773 10 16 10zm0 2a3 3 0 1 0 .002 6.002A3 3 0 0 0 16 12zm-8.75.938A9.006 9.006 0 0 0 7 15c0 1.754.5 3.395 1.375 4.781A23.196 23.196 0 0 1 3.531 16a23.93 23.93 0 0 1 3.719-3.063zm17.5 0A23.93 23.93 0 0 1 28.469 16a23.196 23.196 0 0 1-4.844 3.781A8.929 8.929 0 0 0 25 15c0-.715-.094-1.398-.25-2.063z" />
		                                        </svg></span>
		                                    Quick View
		                                </button>
		                            </div> -->
		                        </div>
		                        <div class="p-4">
		                            <a
		                            @if(isset($products->getProductCategory->catInfo->slug))
		                             href="{{route('productCategory',['category' => $products->getProductCategory->catInfo->slug ])}}"
		                             @else
		                              href="{{route('shop')}}"
		                             @endif
		                             >
		                                <h4
		                                    class="text-lg leading-6 mb-1 text-secondary hover:text-primary font-medium transition duration-200">
		                                   {{$products->name ?? ''}}</h4>
		                            </a>
		                            <p class="text-[15px] text-[#464545] mb-2.5">@if(isset($products->display_mrp_price) && !empty($products->display_mrp_price)) <span class="text-[#fd3d57] " style="text-decoration: line-through;">{{$currency}} {{number_format($products->display_mrp_price , 2) ?? '0'}}</span> @endif {{$currency}} {{number_format($products->display_sale_price , 2) ?? '0'}}/{{$products->display_unit ?? ''}}s</p>
		                            <div class="mr-[5px]">
		                                <span class="text-[#fd3d57] text-xl font-semibold leading-[22px]"> {{$currency}} {{number_format($products->final_sale_price , 2) ?? '0'}} </span>
		                            </div>

		                            

		                        </div>
		                        <div class="w-full"> 
		                            <a 
		                            @if(isset($products->getProductCategory->catInfo->slug)) 
		                            href="{{route('productCategory',['category' => $products->getProductCategory->catInfo->slug ])}}"
		                            @else
		                            href="{{route('shop')}}"
		                            @endif
		                             wire:target="addToCart('{{$products->id}}','{{$type}}')" wire:loading.remove
		                                class="primary-btn w-full rounded-t-none text-base leading-[19px] gap-1.5 p-2 rounded-b-[3px] flex items-center justify-center transition-all duration-500" @php /*  wire:click="addToCart('{{$products->id}}','{{$type}}')" */ @endphp >
		                              <!--   <span class="text-white btn-icon transition duration-500"><svg width="16" height="16"
		                                        viewBox="0 0 32 32">
		                                        <circle cx="10" cy="28" r="2" fill="currentColor" />
		                                        <circle cx="24" cy="28" r="2" fill="currentColor" />
		                                        <path fill="currentColor"
		                                            d="M28 7H5.82L5 2.8A1 1 0 0 0 4 2H0v2h3.18L7 23.2a1 1 0 0 0 1 .8h18v-2H8.82L8 18h18a1 1 0 0 0 1-.78l2-9A1 1 0 0 0 28 7Zm-2.8 9H7.62l-1.4-7h20.53Z" />
		                                    </svg></span> -->
		                               Buy Now
		                            </a> 
		                            <button wire:target="addToCart('{{$products->id}}','{{$type}}')" wire:loading 
						            class="primary-btn w-full rounded-t-none text-base leading-[19px] gap-1.5 p-2 rounded-b-[3px] flex items-center justify-center transition-all duration-500" >
						          
						            Wait...
						        </button>  
		                        </div>
		                    </div>
		                </div>
                	@endforeach 
                @endif 
            </div>
            <div class="swiper-button-next next-btn"></div>
            <div class="swiper-button-prev prev-btn"></div>
        </div>
   
    </div>