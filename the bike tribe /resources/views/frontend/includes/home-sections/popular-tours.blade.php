<section class="layout-pt-md layout-pb-lg">
      <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Popular Tours</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0">Top India Tours & Excursions </p>
            </div>
          </div>
        </div>

        <div data-anim-child="slide-up delay-2" class="tabs -pills-2 pt-40 js-tabs">
          <div class="tabs__controls row x-gap-15 justify-center js-tabs-controls">
           @foreach($global_tour_categories as $key=>  $tourCategory)
            <div class="col-auto">
              <button class="tabs__button text-14 fw-500 px-20 py-10 rounded-4 bg-light-2 js-tabs-button @if($key==0) is-tab-el-active @endif " data-tab-target=".-tab-popular-{{$tourCategory['slug']}}">{{$tourCategory['title']}}</button>
            </div>
            @endforeach 
          </div>

          <div class="tabs__content pt-40 js-tabs-content">

          @foreach($global_tour_categories as $key=>  $tourCategory)
            <div class="tabs__pane -tab-popular-{{$tourCategory['slug']}} @if($key==0) is-tab-el-active @endif">
              <div class="row y-gap-30">
                @foreach($global_tours as $tourKey => $tourInfo)
                  @if($tourInfo['tour_category_id']==$tourCategory['id'])
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
                @endif
                @endforeach 

              </div>

              <div class="row justify-center pt-40">
                <div class="col-auto">

                  <a href="{{route('tours')}}" class="button px-40 h-50 -outline-blue-1 text-blue-1">
                    View All <div class="icon-arrow-top-right ml-15"></div>
                  </a>

                </div>
              </div>
            </div>
          @endforeach

            <div class="tabs__pane -tab-item-2 ">
              <div class="row y-gap-30">

              @for($count=1;$count<=8;$count++)
              <div class="col-xl-3 col-lg-3 col-sm-6">

                  <a href="hotel-single-1.html" class="ToursCard -type-1 ">
                    <div class="ToursCard__image">

                      <div class="cardImage ratio ratio-1:1">
                        <div class="cardImage__content">

                          <img class="rounded-4 col-12" src="{{asset('frontend/')}}/img/hotels/1.png" alt="image">


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

                    <div class="ToursCard__content mt-10">
                      <h4 class="ToursCard__title text-dark-1 text-18 lh-16 fw-500">
                        <span>Delhi Aravalli Organic Ride</span>
                      </h4>

                      <p class="text-light-1 lh-14 text-14 mt-5">Delhi </p>

                      <div class="d-flex items-center mt-20">
                        <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">4.8</div>
                        <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                        <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                      </div>

                      <div class="mt-5">
                        <div class="fw-500">
                          Starting from <span class="text-blue-1">US$72</span>
                        </div>
                      </div>
                    </div>
                  </a>

                </div>
                @endfor 
              </div>

              <div class="row justify-center pt-40">
                <div class="col-auto">

                  <a href="{{route('tours')}}" class="button px-40 h-50 -outline-blue-1 text-blue-1">
                    View All <div class="icon-arrow-top-right ml-15"></div>
                  </a>

                </div>
              </div>
            </div>

            <div class="tabs__pane -tab-item-3 ">
              <div class="row y-gap-30">
                 @for($count=1;$count<=8;$count++)
                <div class="col-xl-3 col-lg-3 col-sm-6">

                  <a href="hotel-single-1.html" class="ToursCard -type-1 ">
                    <div class="ToursCard__image">

                      <div class="cardImage ratio ratio-1:1">
                        <div class="cardImage__content">

                          <img class="rounded-4 col-12" src="{{asset('frontend/')}}/img/hotels/1.png" alt="image">


                        </div>

                        <div class="cardImage__wishlist">
                          <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                            <i class="icon-heart text-12"></i>
                          </button>
                        </div>


                        <div class="cardImage__leftBadge">
                          <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-yellow-1 text-white">
                           Top Rated
                          </div>
                        </div>

                      </div>

                    </div>

                    <div class="ToursCard__content mt-10">
                      <h4 class="ToursCard__title text-dark-1 text-18 lh-16 fw-500">
                        <span>The Montcalm At Brewery London City</span>
                      </h4>

                      <p class="text-light-1 lh-14 text-14 mt-5">Westminster Borough, London</p>

                      <div class="d-flex items-center mt-20">
                        <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">4.8</div>
                        <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                        <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                      </div>

                      <div class="mt-5">
                        <div class="fw-500">
                          Starting from <span class="text-blue-1">US$72</span>
                        </div>
                      </div>
                    </div>
                  </a>

                </div>

                @endfor 
             

              </div>

              <div class="row justify-center pt-40">
                <div class="col-auto">

                  <a href="{{route('tours')}}" class="button px-40 h-50 -outline-blue-1 text-blue-1">
                    View All <div class="icon-arrow-top-right ml-15"></div>
                  </a>

                </div>
              </div>
            </div>

            <div class="tabs__pane -tab-item-4 ">
              <div class="row y-gap-30">

                @for($count=1;$count<=8;$count++)

                <div class="col-xl-3 col-lg-3 col-sm-6">

                  <a href="hotel-single-1.html" class="ToursCard -type-1 ">
                    <div class="ToursCard__image">

                      <div class="cardImage ratio ratio-1:1">
                        <div class="cardImage__content">


                          <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                            <div class="swiper-wrapper">

                              <div class="swiper-slide">
                                <img class="col-12" src="{{asset('frontend/')}}/img/hotels/2.png" alt="image">
                              </div>

                              <div class="swiper-slide">
                                <img class="col-12" src="{{asset('frontend/')}}/img/hotels/1.png" alt="image">
                              </div>

                              <div class="swiper-slide">
                                <img class="col-12" src="{{asset('frontend/')}}/img/hotels/3.png" alt="image">
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

                        <div class="cardImage__leftBadge">
                        <div class="py-5 px-15 rounded-right-4 text-12 lh-16 fw-500 uppercase bg-brown-1 text-white">
                           25% Discount Today
                          </div>
                        </div>


                      </div>

                    </div>

                    <div class="ToursCard__content mt-10">
                      <h4 class="ToursCard__title text-dark-1 text-18 lh-16 fw-500">
                        <span>Staycity ApartTours Deptford Bridge Station</span>
                      </h4>

                      <p class="text-light-1 lh-14 text-14 mt-5">Ciutat Vella, Barcelona</p>

                      <div class="d-flex items-center mt-20">
                        <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">4.8</div>
                        <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                        <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                      </div>

                      <div class="mt-5">
                        <div class="fw-500">
                          Starting from <span class="text-blue-1">US$72</span>
                        </div>
                      </div>
                    </div>
                  </a>

                </div>
                @endfor
                
              </div>

              <div class="row justify-center pt-40">
                <div class="col-auto">

                  <a href="{{route('tours')}}" class="button px-40 h-50 -outline-blue-1 text-blue-1">
                    View All <div class="icon-arrow-top-right ml-15"></div>
                  </a>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
