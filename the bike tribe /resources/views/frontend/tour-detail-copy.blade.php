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
            @if($data->included)
            <div class="mt-40 border-top-light">
              <div class="row x-gap-40 y-gap-40 pt-40">
                <div class="col-12">
                  <h3 class="text-22 fw-500">What's Included</h3> 
                  <div class="row x-gap-40 y-gap-40 pt-20">
                    <div class="col-md-6">
                      {!!nl2br($data->included)!!} 
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($data->excluded)
            <div class="mt-40 border-top-light">
              <div class="row x-gap-40 y-gap-40 pt-40">
                <div class="col-12">
                  <h3 class="text-22 fw-500">What's Excluded</h3> 
                  <div class="row x-gap-40 y-gap-40 pt-20">
                    <div class="col-md-6">
                      {!!nl2br($data->excluded)!!} 
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            @endif
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

              <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">Terrain/ Riding Conditions:</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
					<p class="text-15">
					<ul class="list-disc text-15 mt-10">
					<li>60% Tarmac and 40% Gravel (best suited for <strong>MTB</strong>)</li>
					<li>Full Vehicle Support</li>
					<li>Approximate 4 – 6 hours cycling in a day</li>
					</ul>
					<p class="text-dark-1 text-15 mt-20"><strong>Group Size: </strong>4 to 16 Participants <strong>Min. Age: </strong>12 Years</p>
					<p class="text-dark-1 text-15 mt-20">This Tour is mostly on tarmac and dirty village roads. A support vehicle will accompany the group to support, carry luggage and any participant, in case of exhaustion, fatigue, or injury. Roads are well made at the majority of the locations and are mostly plain undulating roads all the way. The roads we take a pass through the Aravali hill ranges, villages, temples, lakes etc</p>
					</p>
                    </div>
                  </div>
                </div>
              </div>

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
					<ul class="list-disc text-15 mt-10">
					<li>Meals – 1 Lunch (Organic and Farm Fresh)</li>
					<li>Filtered Water and Refreshments </li>
					<li>1 Support Vehicle</li>
					<li>Team Leader/ Tour Guide</li>
					<li>Bike/ Cycle Technician</li>
					<li>Basic First Aid</li>
					</ul>
					
					</p>
                    </div>
                  </div>
                </div>
              </div>

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
					<ul class="list-disc text-15 mt-10">
					<li>Any kind of Beverages</li>
					<li>Emergency evacuations</li>
					<li>Breakdown/ Repair expenses</li>
					<li>Any Personal Expenses</li>
					<li>Gratitudes</li>
					</ul>
					</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">Physical Fitness</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
                      <p class="text-dark-1 text-15 mt-20">Even though this is not an exhaustive trip, it is necessary to be physically fit and active to appreciate the experience that this Tour has to offer. The ride is open to all amateur and seasoned cycling enthusiasts who are physically fit to endure and enjoy riding. There shall be mostly plain roads along the entire route with small undulating roads hence, we only recommend riders who are physically fit and have basic cycle riding capability.</p>

 <p class="text-dark-1 text-15 mt-20">This Tour includes five days of riding at altitudes ranging from 50 metres to 250 metres and riders will be covering an average distance of 25 to 50 kilometres per day (approximately).</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">Climate</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
                      <p class="text-15">The weather is mostly hot during the day with temperatures varying from 1 degrees Celsius to 25 degrees Celsius in winters and 30 degrees Celsius to 45 degrees Celsius in Summers. Though we are always observant about the changing weather, no one can guarantee rain or the sun. Do understand that your safety is of utmost importance to us and we will not proceed any further from the destination if the weather is not favorable, especially when it’s too hot to bear and there can be chances of heatstroke.</p>
                    </div>
                  </div>
                </div>
              </div>
			  
			  <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">Transportation</div>
                  </div>

                  <div class="accordion__content">
                    <div class="pt-20 pl-60">
                      <p class="text-15">We use an airconditioned experienced chauffeur for this tour for your comfort and safety as a support vehical, hotel pick up and drop isn’t included in the tour cost. Check with us prior to your arrival or departure if you want us to include transport services which will be charged separately. You can email us thebiketribe@gmail.com or info@thebiketribe.in or call/ WhatsApp us in +91 9315028184.</p>
                    </div>
                  </div>
                </div>
              </div>
			  
			  <div class="col-12">
                <div class="accordion__item px-20 py-20 border-light rounded-4">
                  <div class="accordion__button d-flex items-center">
                    <div class="accordion__icon size-40 flex-center bg-light-2 rounded-full mr-20">
                      <i class="icon-plus"></i>
                      <i class="icon-minus"></i>
                    </div>

                    <div class="button text-dark-1">Food</div>
                  </div>

                  <div class="accordion__content">
				<div class="pt-20 pl-60">
				<p class="text-15">We make sure all the food we offer/ recommend is freshly cooked and you get to experience a hint of the local delicacy.</p>
				
				<p class="text-15">Packed Lunch/Lunch in a Local restaurant, Fruits and Water will be provided when riding.</p>
				
				<p class="text-15">Any special dietary requirements, please let us know at the time of booking.</p>
				</div>
                  </div>
                </div>
              </div>

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
              <p class=" sectionTitle__text mt-5 sm:mt-0">Interdum et malesuada fames ac ante ipsum</p>
            </div>
          </div>

          <div class="col-auto">

            <a href="#" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1">
              See All <div class="icon-arrow-top-right ml-15"></div>
            </a>

          </div>
        </div>

        <div class="row y-gap-30 pt-40 sm:pt-20">

          <div class="col-xl-3 col-lg-3 col-sm-6">

            <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
              <div class="tourCard__image">

                <div class="cardImage ratio ratio-1:1">
                  <div class="cardImage__content">

                    <img class="rounded-4 col-12" src="{{asset('frontend/')}}/img/tours/1.png" alt="image">


                  </div>

                  <div class="cardImage__wishlist">
                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                      <i class="icon-heart text-12"></i>
                    </button>
                  </div>


                  <div class="cardImage__leftBadge">
                    <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-dark-1 text-white">
                      LIKELY TO SELL OUT*
                    </div>
                  </div>

                </div>

              </div>

              <div class="tourCard__content mt-10">
                <div class="d-flex items-center lh-14 mb-5">
                  <div class="text-14 text-light-1">16+ hours</div>
                  <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                  <div class="text-14 text-light-1">Full-day Tours</div>
                </div>

                <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                  <span>Stonehenge, Windsor Castle and Bath with Pub Lunch in Lacock</span>
                </h4>

                <p class="text-light-1 lh-14 text-14 mt-5">Westminster Borough, London</p>

                <div class="row justify-between items-center pt-15">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="d-flex items-center x-gap-5">

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                      </div>

                      <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                    </div>
                  </div>

                  <div class="col-auto">
                    <div class="text-14 text-light-1">
                      From
                      <span class="text-16 fw-500 text-dark-1">US$72</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="col-xl-3 col-lg-3 col-sm-6">

            <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
              <div class="tourCard__image">

                <div class="cardImage ratio ratio-1:1">
                  <div class="cardImage__content">


                    <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                      <div class="swiper-wrapper">

                        <div class="swiper-slide">
                          <img class="col-12" src="{{asset('frontend/')}}/img/tours/2.png" alt="image">
                        </div>

                        <div class="swiper-slide">
                          <img class="col-12" src="{{asset('frontend/')}}/img/tours/1.png" alt="image">
                        </div>

                        <div class="swiper-slide">
                          <img class="col-12" src="{{asset('frontend/')}}/img/tours/3.png" alt="image">
                        </div>

                      </div>

                      <div class="cardImage-slider__pagination js-pagination"></div>

                      <div class="cardImage-slider__nav -prev">
                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-prev">
                          <i class="icon-chevron-left text-10"></i>
                        </button>
                      </div>

                      <div class="cardImage-slider__nav -next">
                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-next">
                          <i class="icon-chevron-right text-10"></i>
                        </button>
                      </div>
                    </div>

                  </div>

                  <div class="cardImage__wishlist">
                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                      <i class="icon-heart text-12"></i>
                    </button>
                  </div>


                </div>

              </div>

              <div class="tourCard__content mt-10">
                <div class="d-flex items-center lh-14 mb-5">
                  <div class="text-14 text-light-1">9+ hours</div>
                  <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                  <div class="text-14 text-light-1">Attractions &amp; Museums</div>
                </div>

                <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                  <span>Westminster Walking Tour & Westminster Abbey Entry</span>
                </h4>

                <p class="text-light-1 lh-14 text-14 mt-5">Ciutat Vella, Barcelona</p>

                <div class="row justify-between items-center pt-15">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="d-flex items-center x-gap-5">

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                      </div>

                      <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                    </div>
                  </div>

                  <div class="col-auto">
                    <div class="text-14 text-light-1">
                      From
                      <span class="text-16 fw-500 text-dark-1">US$72</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="col-xl-3 col-lg-3 col-sm-6">

            <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
              <div class="tourCard__image">

                <div class="cardImage ratio ratio-1:1">
                  <div class="cardImage__content">

                    <img class="rounded-4 col-12" src="{{asset('frontend/')}}/img/tours/3.png" alt="image">


                  </div>

                  <div class="cardImage__wishlist">
                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                      <i class="icon-heart text-12"></i>
                    </button>
                  </div>


                  <div class="cardImage__leftBadge">
                    <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-blue-1 text-white">
                      Best Seller
                    </div>
                  </div>

                </div>

              </div>

              <div class="tourCard__content mt-10">
                <div class="d-flex items-center lh-14 mb-5">
                  <div class="text-14 text-light-1">40–55 minutes</div>
                  <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                  <div class="text-14 text-light-1">Private and Luxury</div>
                </div>

                <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                  <span>High-Speed Thames River RIB Cruise in London</span>
                </h4>

                <p class="text-light-1 lh-14 text-14 mt-5">Manhattan, New York</p>

                <div class="row justify-between items-center pt-15">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="d-flex items-center x-gap-5">

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                      </div>

                      <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                    </div>
                  </div>

                  <div class="col-auto">
                    <div class="text-14 text-light-1">
                      From
                      <span class="text-16 fw-500 text-dark-1">US$72</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="col-xl-3 col-lg-3 col-sm-6">

            <a href="tour-single.html" class="tourCard -type-1 rounded-4 ">
              <div class="tourCard__image">

                <div class="cardImage ratio ratio-1:1">
                  <div class="cardImage__content">

                    <img class="rounded-4 col-12" src="{{asset('frontend/')}}/img/tours/4.png" alt="image">


                  </div>

                  <div class="cardImage__wishlist">
                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                      <i class="icon-heart text-12"></i>
                    </button>
                  </div>


                  <div class="cardImage__leftBadge">
                    <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-yellow-1 text-dark-1">
                      Top Rated
                    </div>
                  </div>

                </div>

              </div>

              <div class="tourCard__content mt-10">
                <div class="d-flex items-center lh-14 mb-5">
                  <div class="text-14 text-light-1">94+ days</div>
                  <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                  <div class="text-14 text-light-1">Bus Tours</div>
                </div>

                <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                  <span>Edinburgh Darkside Walking Tour: Mysteries, Murder and Legends</span>
                </h4>

                <p class="text-light-1 lh-14 text-14 mt-5">Vaticano Prati, Rome</p>

                <div class="row justify-between items-center pt-15">
                  <div class="col-auto">
                    <div class="d-flex items-center">
                      <div class="d-flex items-center x-gap-5">

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                        <div class="icon-star text-yellow-1 text-10"></div>

                      </div>

                      <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                    </div>
                  </div>

                  <div class="col-auto">
                    <div class="text-14 text-light-1">
                      From
                      <span class="text-16 fw-500 text-dark-1">US$72</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

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
