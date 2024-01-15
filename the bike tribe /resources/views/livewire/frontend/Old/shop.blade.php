<div>
    <!-- breadcrumbs -->
    <div class="container">
      <div class="py-5 flex items-center">
          <a href="{{route('homePage')}}" class="flex  items-center">
              <span class="text-primary">
                  <svg width="17" height="17" viewBox="0 0 32 32">
                      <path fill="currentColor"
                          d="m16 2.594l-.719.687l-13 13L3.72 17.72L5 16.437V28h9V18h4v10h9V16.437l1.281 1.282l1.438-1.438l-13-13zm0 2.844l9 9V26h-5V16h-8v10H7V14.437z" />
                  </svg></span>
              <span>
                  <svg width="22" height="22" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M10 6L8.59 7.41L13.17 12l-4.58 4.59L10 18l6-6l-6-6z" /></svg>
              </span>
          </a>
          <a href="{{route('shop')}}" class="text-primary text-[13px] sm:text-base">Shop</a>
          <span>
              <svg width="22" height="22" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M10 6L8.59 7.41L13.17 12l-4.58 4.59L10 18l6-6l-6-6z" /></svg>
          </span>
          @if(isset($selectedCatInfo->name))
          {{$selectedCatInfo->name}}
          @elseif(isset($searchkey))
          Search : {{$searchkey}}
          @endif 
      </div>
  </div>
  <!-- breadcrumbs end-->

  <!-- shop grid view -->
  <div class="pb-14 relative">
      <div class="container">
          <div x-data="{isOpen:false}" class="grid grid-cols-4 relative gap-6">
              <div class="col-span-1">
                  <div :class="isOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                      class="lg:opacity-100 lg:visible transition-all duration-300 absolute bg-white top-[80px] left-0 lg:static w-[320px] shadow lg:w-full p-4 z-20">
                      <!-- <div class="sm:hidden">
                          <div class="flex justify-between items-center">
                              <h4 class="text-xl uppercase">Sort by</h4>
                              <button @click="isOpen=false" class="text-primary">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                      stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                              </button>
                          </div>
                          <div class="border-b pb-14 rounded mt-5">
                              <select class="nice_select nice-select">
                                  <option selected>Default sorting</option>
                                  <option>Price low-high</option>
                                  <option>Price high-low</option>
                              </select>
                          </div>
                      </div> -->

                      <div class="mt-6 sm:mt-2">
                          <div class="pb-4 border-b border-[#E9E4E4] mb-4">
                              <div class="flex justify-between items-start">
                                  <h4 class="text-xl text-left font-medium mb-3 text-secondary uppercase">Categories
                                  </h4>
                                  <!-- close filter -->
                                  <button @click="isOpen=false" class="text-primary sm:block lg:hidden closefilter">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                          stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 18L18 6M6 6l12 12" />
                                      </svg>
                                  </button>
                              </div>
                              <div class="space-y-2">
                                @if(isset($fruitsCategories) && !empty($fruitsCategories))
                                  @foreach($fruitsCategories as $categoryInfo)
                                    <div class="custom_check flex justify-between items-center">
                                        <div class="flex gap-3 items-center">
                                            <input type="checkbox"
                                                class="focus:ring-0 text-primary focus:bg-primary focus:outline-none"
                                                 onchange="setCategory({{$categoryInfo->id}})"  @if(in_array($categoryInfo->id,$filterCategories)) checked @endif id="category-{{$categoryInfo->id}}" value="{{$categoryInfo->id}}"

                                                    >
                                            <label for="cat-women" class="cursor-pointer text-secondary">{{$categoryInfo->name ?? ''}}</label>
                                        </div>
                                        {{-- <p>(16)</p> --}}
                                    </div>
                                  @endforeach
                                @endif


                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div x-data class="col-span-4 lg:col-span-3">
                  <div class="flex items-center">
                      <div class="lg:hidden block pr-4">
                          <button @click="isOpen=true"
                              class="pt-2 pb-[9px] border border-primary px-2.5 min-w-[150px] primary-btn"
                              id="mobile_filter_btn">FILTER</button>
                      </div> 
                  </div>
                  
                  <div wire:loading.remove class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                  	
                  	
                    @if(isset($productList) && count($productList))
                      @foreach($productList as $products)
                        @php $key = $products->id; @endphp
                        <livewire:frontend.product-component :products=$products :searchkey=$searchkey :key=$key />
                      @endforeach 
                    @endif 
                    
                  </div>
                   <div wire:loading class="container" >
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                          @for($count=1;$count<=12;$count++)
                       <div class="product-card-placeholder animate-pulse">
                      <div class="product-image-placeholder"></div>
                      <div class="product-text-placeholder w-2-3"></div>
                      <div class="product-text-placeholder w-1-3"></div>
                      <div class="product-text-placeholder w-1-2"></div>
                      <div class="product-text-placeholder w-button"></div>
                  </div>
                          @endfor
                       </div>
                  </div>


                  @if(count($productList)==0)
                       No products found, please refine your search.
                      @endif 
              </div>

          </div>
           @if(count($productList)>0)
           <div id="shopPagination" class="mt-5 flex items-center justify-center gap-2.5">
                    {{ $productList->links() }}
            </div>
            @endif 
      </div>
  </div>
  <!-- shop grid view end-->
  <script>
function setCategory(category_id)
{ 
    @this.setCategoriesFilter(category_id);
} 
  </script>
</div>