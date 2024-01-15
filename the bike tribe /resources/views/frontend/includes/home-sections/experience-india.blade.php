 <section class="layout-pt-lg layout-pb-md">
      <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row y-gap-20 justify-center text-center">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Experience India On A Bike</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0"> Adventures We Offer</p>
            </div>
          </div>
        </div>

        <div data-anim-child="slide-up delay-2" class="relative pt-40 js-section-slider" data-gap="30" data-slider-cols="xl-6 lg-4 md-3 sm-2 base-1">
          <div class="swiper-wrapper">
           @foreach($destinations as $destinationInfo)
            <div class="swiper-slide">

              <a href="javascript:void('0')" class="citiesCard -type-2 ">
                @if(!empty($destinationInfo->featured_image))
                <div class="citiesCard__image rounded-4 ratio ratio-1:1">
                  <img class="img-ratio rounded-4 js-lazy"
                  src=""
                   data-src="{{asset('storage/'.$destinationInfo->featured_image)}}" src="#" alt="{{$destinationInfo->title}} ">
                </div>
                @endif 
                <div class="citiesCard__content mt-10">
                  <h4 class="text-18 lh-13 fw-500 text-dark-1">{{$destinationInfo->title}} </h4>
                  <div class="text-14 text-light-1">{{$destinationInfo->short_description}} </div>
                </div>
              </a>

            </div>
            @endforeach 
 

          </div>


          <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
            <i class="icon icon-chevron-left text-12"></i>
          </button>

          <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
            <i class="icon icon-chevron-right text-12"></i>
          </button>

        </div>
      </div>
    </section>