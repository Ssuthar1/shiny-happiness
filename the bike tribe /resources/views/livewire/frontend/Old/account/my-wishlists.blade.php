<div class="col-span-12 lg:col-span-9">
            
            @foreach($wishlists as $key => $products)
            <div class="md:flex justify-between items-center border rounded p-5 @if($key>0) mt-6 @endif">
                 @if(isset($products->image))
                <div class="w-20 h-20">
                    <img loading="lazy" class="w-full h-full object-cover" src="{{ route('displayImage') }}?imagepath={{ $products->image }}" alt="{{$products->name}}" title="{{$products->name}}">
                </div>
                @endif
                <div class="mt-6 md:mt-0">
                    <a href="product-view.html" class="hover:text-primary transition durition-300">
                        <h5>{{$products->name}}</h5>
                    </a>
                     
                </div>

                <div class="text-[18px] text-primary font-semibold mt-2 md:mt-0">
                    @if(isset($products->display_mrp_price) && !empty($products->display_mrp_price)) <span class="text-[#fd3d57] " style="text-decoration: line-through;"> {{$currency}} {{number_format($products->display_mrp_price , 2) ?? '0'}}</span> @endif {{$currency}} {{number_format($products->display_sale_price , 2) ?? '0'}}/{{$products->display_unit ?? ''}}
                </div>
                <div class="flex justify-between md:gap-12 items-center mt-4 md:mt-0">
                    <div class="group">
                        <button wire:click="addToCart('{{$products->id}}')"
                            class="flex gap-2 items-center border border-primary bg-primary text-white text-sm uppercase px-4 py-2 rounded hover:bg-white hover:text-primary transition duration-300">
                            <span class="text-white group-hover:text-primary transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 256 256">
                                    <path fill="currentColor"
                                        d="m209.7 131.9l12.2-66.8a6.1 6.1 0 0 0-1.3-4.9A5.8 5.8 0 0 0 216 58H53l-5.2-28.5A13.9 13.9 0 0 0 34.1 18H16a6 6 0 0 0 0 12h18.1a2 2 0 0 1 1.9 1.6l27.7 152.2A26 26 0 1 0 106 204a25.6 25.6 0 0 0-4.1-14h60.2a25.6 25.6 0 0 0-4.1 14a26 26 0 1 0 26-26H74.8l-5.1-28h118.4a22 22 0 0 0 21.6-18.1ZM94 204a14 14 0 1 1-14-14a14 14 0 0 1 14 14Zm104 0a14 14 0 1 1-14-14a14 14 0 0 1 14 14ZM55.2 70h153.6l-10.9 59.8a10 10 0 0 1-9.8 8.2H67.6Z" />
                                </svg>
                            </span> Add
                            to Cart</button>
                    </div>
                    <div class="cursor-pointer hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6q-.425 0-.713-.287Q4 5.425 4 5t.287-.713Q4.575 4 5 4h4q0-.425.288-.713Q9.575 3 10 3h4q.425 0 .713.287Q15 3.575 15 4h4q.425 0 .712.287Q20 4.575 20 5t-.288.713Q19.425 6 19 6v13q0 .825-.587 1.413Q17.825 21 17 21ZM7 6v13h10V6Zm2 10q0 .425.288.712Q9.575 17 10 17t.713-.288Q11 16.425 11 16V9q0-.425-.287-.713Q10.425 8 10 8t-.712.287Q9 8.575 9 9Zm4 0q0 .425.288.712q.287.288.712.288t.713-.288Q15 16.425 15 16V9q0-.425-.287-.713Q14.425 8 14 8t-.712.287Q13 8.575 13 9ZM7 6v13V6Z" />
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
             
<script>
    
 window.addEventListener('toast:cartSuccess', event => {

    Toastify({
  text: event.detail.text,
  className: "error",
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  }
}).showToast();

           

        });
  </script>
        </div>