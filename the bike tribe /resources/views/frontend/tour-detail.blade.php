 <x-front-app-layout> 
    <section class="py-10 d-flex items-center bg-light-2">
      <div class="container">
        <div class="row y-gap-10 items-center justify-between">
          <div class="col-auto">
            <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
              <div class="col-auto">
                <div class="">Home</div>
              </div>
              <div class="col-auto">
                <div class="">></div>
              </div>
              @if($data->tourCategory->title)
              <div class="col-auto">
                <div class="">{{$data->tourCategory->title}}</div>
              </div>
              @endif
              <div class="col-auto">
                <div class="">></div>
              </div>
              <div class="col-auto">
                <div class="text-dark-1">{{$data->title}}</div>
              </div>
            </div>
          </div>

          <!-- <div class="col-auto">
            <a href="#" class="text-14 text-blue-1 underline">All Hotel in London</a>
          </div> -->
        </div>
      </div>
    </section>

    <section class="pt-40">
      <div class="container">
        <div class="row y-gap-15 justify-between items-end">
          <div class="col-auto">
            <h1 class="text-30 fw-600">{{$data->title}}</h1>

            <div class="row x-gap-20 y-gap-20 items-center pt-10">
              <div class="col-auto">
                <div class="d-flex items-center">
                  <div class="d-flex x-gap-5 items-center">

                    <i class="icon-star text-10 text-yellow-1"></i>

                    <i class="icon-star text-10 text-yellow-1"></i>

                    <i class="icon-star text-10 text-yellow-1"></i>

                    <i class="icon-star text-10 text-yellow-1"></i>

                    <i class="icon-star text-10 text-yellow-1"></i>

                  </div>

                  <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                </div>
              </div>

              <div class="col-auto">
                <div class="row x-gap-10 items-center">
                  <div class="col-auto">
                    <div class="d-flex x-gap-5 items-center">
                      <i class="icon-placeholder text-16 text-light-1"></i>
                      <div class="text-15 text-light-1">Greater London, United Kingdom</div>
                    </div>
                  </div>

                  <div class="col-auto">
                    <button data-x-click="mapFilter" class="text-blue-1 text-15 underline">Show on map</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-auto">
            <div class="row x-gap-10 y-gap-10">
              <div class="col-auto">
                <button class="button px-15 py-10 -blue-1">
                  <i class="icon-share mr-10"></i>
                  Share
                </button>
              </div>

              <div class="col-auto">
                <button class="button px-15 py-10 -blue-1 bg-light-2">
                  <i class="icon-heart mr-10"></i>
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="pt-40 js-pin-container">
      <div class="container">
        <div class="row y-gap-30">
          <div class="col-lg-8">
            <div class="relative d-flex justify-center overflow-hidden js-section-slider" data-slider-cols="base-1" data-nav-prev="js-img-prev" data-nav-next="js-img-next">
              <div class="swiper-wrapper">
                @if($data->getGalleryImages)
                @foreach($data->getGalleryImages as $galleryImages)
                <div class="swiper-slide">
                  <img src="{{asset('storage/'.$galleryImages->id.'/'.$galleryImages->file_name)}}" alt="{{$data->title}}" class="rounded-4 col-12 h-full object-cover">
                </div>
                @endforeach
                @endif 

              </div>

              <div class="absolute h-full col-11">

                <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-prev">
                  <i class="icon icon-chevron-left text-12"></i>
                </button>

                <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-next">
                  <i class="icon icon-chevron-right text-12"></i>
                </button>

              </div>
            
            </div>

            <h3 class="text-22 fw-500 mt-30">
              Tour Information
            </h3>

            <div class="row y-gap-30 justify-between pt-20">
              @if($data->tour_duration)
              <div class="col-md-auto col-6">
                <div class="d-flex">
                  <i class="icon-clock text-22 text-blue-1 mr-10"></i>
                  <div class="text-15 lh-15">
                    Duration:<br> {{$data->tour_duration}}
                  </div>
                </div>
              </div>
              @endif

              
              @if($data->tour_code)
              <div class="col-md-auto col-6">
                <div class="d-flex">
                  <i class="iconqucode mr-10"><img src="{{asset('frontend/')}}/img/icons/qucode.png"></i>
                  <div class="text-15 lh-15">
                   Tour Code<br> {{$data->tour_code}}
                  </div>
                </div>
              </div>
              @endif
              @if($data->start_price)
              <div class="col-md-auto col-6">
                <div class="d-flex">
                  <i class="icon-price-label text-22 text-blue-1 mr-10"></i>
                  <div class="text-15 lh-15">
                    Price <br>from {{$currency}}{{$data->start_price}}
                  </div>
                </div>
              </div>
              @endif

            </div>

            <div class="border-top-light mt-40 mb-40"></div>

            <div class="row x-gap-40 y-gap-40">
              <div class="col-12">
                <h3 class="text-22 fw-500">Overview</h3> 
                <p class="text-dark-1 text-15 mt-20">{!!$data->description!!} </p>  
              </div> 
              
            </div>
            
      
          </div>

         @include('frontend.includes.tour-booking-sidebar') 
        </div>
      </div>
    </section>
<div class="container mt-40 mb-40">
      <div class="border-top-light"></div>
    </div>
    
    

    <section>
      <div class="container">

        <div class="row y-gap-30">
          <div class="col-lg-6">
		          <h3 class="text-22 fw-500 mb-20">Itinerary</h3>

            <div class="relative">
              <div class="border-test"></div>

              <div class="accordion -map row y-gap-20 js-accordion">

              
               
               @foreach($data->getItineraries() as $key => $itineraryInfo)
                <div class="col-12">
                  <div class="accordion__item @if($key==0) js-accordion-item-active @endif">
                    <div class="d-flex">
                      <div class="accordion__icon size-40 flex-center bg-blue-2 text-blue-1 rounded-full">
                        <div class="text-14 fw-500">{{++$key}}</div>
                      </div> 
                      <div class="ml-20">
                        @if(isset($itineraryInfo['title']))
                        <div class="text-16 lh-15 fw-500">{{$itineraryInfo['title']}}</div>
                        @endif

                        <div class="accordion__content">
                          <div class="pt-15 pb-15"> 
                            @if(isset($itineraryInfo['desc']))
                            <div class="text-14 lh-17 mt-15">{!!nl2br($itineraryInfo['desc'])!!}</div>
                            @endif
                          </div>
                        </div>

                        <div class="accordion__button">
                          <button data-open-change-title="See less" class="d-block lh-15 text-14 text-blue-1 underline fw-500 mt-5">
                            See details
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach 

              </div>
            </div>
          </div>

          <div class="col-lg-6">
		  	          <h3 class="text-22 fw-500 mb-20">Details</h3>

            <div class="accordion -simple row y-gap-20 js-accordion">

            
                @if($data->included)
              <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">What's Included</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
					<p class="text-15">
					  {!!nl2br($data->included)!!} 
					
					</p>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @if($data->excluded)
              <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">What's Excluded</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
                      <p class="text-15">
					 {!!nl2br($data->excluded)!!} 
					</p>
                    </div>
                  </div>
                </div>
              </div>
              @endif 

            </div>
          </div>
        </div>
      </div>
    </section>



    <div class="container">
      <div class="mt-50 border-top-light"></div>
    </div>

    <section class="layout-pt-lg layout-pb-lg">
      <div class="container">
        <div class="row justify-between items-end">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Related Tour</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0">you may also like to visit similar tours</p>
            </div>
          </div> 
          <div class="col-auto">

          @php /*  <a href="#" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1">
              See All <div class="icon-arrow-top-right ml-15"></div>
            </a> */ @endphp

          </div>
        </div>

        <div class="row y-gap-30 pt-40 sm:pt-20">
        @foreach($global_tour_categories as $key=>  $tourCategory)
          @if($data->tour_category_id == $tourCategory['id']) 
          @php shuffle($global_tours);
          $counter=1;
           @endphp 
          @foreach($global_tours as $tourKey => $tourInfo)
                  @if($tourInfo['tour_category_id']==$data->tour_category_id && $counter<=4 )

            <div class="col-xl-3 col-lg-3 col-sm-6">

                  <a href="{{route('toursDetail',$tourInfo['slug'])}}" class="ToursCard -type-1 ">
                    <div class="ToursCard__image">

                      <div class="cardImage ratio ratio-1:1">
                        <div class="cardImage__content">

                          <img class="rounded-4 col-12" src="{{asset('storage/'.$tourInfo['featured_image'])}}" alt="{{$tourInfo['title']}}" title="{{$tourInfo['title']}}">


                        </div>

                        <div class="cardImage__wishlist">
                          <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                            <i class="icon-heart text-12"></i>
                          </button>
                        </div>


                        <div class="cardImage__leftBadge">
                          <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-blue-1 text-white">
                          Popular Tours
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="ToursCard__content mt-10">
                      <h4 class="ToursCard__title text-dark-1 text-18 lh-16 fw-500">
                        <span>{{$tourInfo['title']}}</span>
                      </h4>

                      <p class="text-light-1 lh-14 text-14 mt-5"> Delhi </p>

                     @php /* <div class="d-flex items-center mt-20">
                        <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">4.8</div>
                        <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                        <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                      </div> */ @endphp

                      <div class="mt-5">
                        <div class="fw-500">
                          @if(!empty($tourInfo['start_price']))
                            Starting from <span class="text-blue-1">{{$currency}}{{$tourInfo['start_price']}}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </a>

                </div>
          @php $counter++; @endphp
              @endif
          @endforeach
          @endif
        @endforeach
 

        </div>
      </div>
    </section>

    <section class="layout-pt-md layout-pb-md bg-dark-2">
      <div class="container">
        <div class="row y-gap-30 justify-between items-center">
          <div class="col-auto">
            <div class="row y-gap-20  flex-wrap items-center">
              <div class="col-auto">
                <div class="icon-newsletter text-60 sm:text-40 text-white"></div>
              </div>

              <div class="col-auto">
                <h4 class="text-26 text-white fw-600">Your Travel Journey Starts Here</h4>
                <div class="text-white">Sign up and we'll send the best deals to you</div>
              </div>
            </div>
          </div>
          @php $location = 'inner'; @endphp
          <livewire:frontend.subscriber-user /> 
        </div>
      </div>
    </section>

</x-front-app-layout> 
