<section class="section-bg layout-pt-lg layout-pb-lg">
      <div class="section-bg__item -mx-20 bg-light-2"></div>

      <div data-anim-wrap class="container">
        <div data-anim-child="slide-up delay-1" class="row justify-center text-center">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Overheard from travelers</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0">have a look from some of our clients</p>
            </div>
          </div>
        </div>

        <div class="relative mt-80 md:mt-40 js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1">
          <div class="swiper-wrapper">
              @foreach($testimonials as $key=>  $testimonial)
            <div data-anim-child="slide-up delay-{{$key+2}}" class="swiper-slide">
              <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40">
                <h4 class="text-16 fw-500 text-blue-1 mb-20">{{$testimonial->title}}</h4>
                <p class="testimonials__text lh-18 fw-500 text-dark-1">&quot;{!!$testimonial->description!!}&quot;</p>

                <div class="pt-20 mt-28 border-top-light">
                  <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                      @if(!empty($testimonial->image))
                      <img class="size-60" src="{{asset('storage/'.$testimonial->image)}}"  alt="{{$testimonial->name}}">
                      @endif
                    </div>

                    <div class="col-auto">
                      <div class="text-15 fw-500 lh-14">{{$testimonial->name}}</div>
                      <div class="text-14 lh-14 text-light-1 mt-5">{{$testimonial->designation}}</div>
                    </div>
                  </div>
                </div>
              </div>
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

        <div data-anim-child="fade delay-6" class="row y-gap-30 items-center pt-40 sm:pt-20">
          <div class="col-xl-4">
            <div class="row y-gap-30 text-dark-1">
              <div class="col-sm-5 col-6">
                <div class="text-30 lh-15 fw-600">13m+</div>
                <div class="lh-15">Happy People</div>
              </div>

              <div class="col-sm-5 col-6">
                <div class="text-30 lh-15 fw-600">4.88</div>
                <div class="lh-15">Overall rating</div>

                <div class="d-flex x-gap-5 items-center pt-10">

                  <div class="icon-star text-dark-1 text-10"></div>

                  <div class="icon-star text-dark-1 text-10"></div>

                  <div class="icon-star text-dark-1 text-10"></div>

                  <div class="icon-star text-dark-1 text-10"></div>

                  <div class="icon-star text-dark-1 text-10"></div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-8">
            <div class="row y-gap-30 justify-between items-center">

              <div class="col-md-auto col-sm-6">
                <div class="d-flex justify-center">
                  <img src="{{asset('frontend/')}}/img/clients/1.svg" alt="image">
                </div>
              </div>

              <div class="col-md-auto col-sm-6">
                <div class="d-flex justify-center">
                  <img src="{{asset('frontend/')}}/img/clients/2.svg" alt="image">
                </div>
              </div>

              <div class="col-md-auto col-sm-6">
                <div class="d-flex justify-center">
                  <img src="{{asset('frontend/')}}/img/clients/3.svg" alt="image">
                </div>
              </div>

              <div class="col-md-auto col-sm-6">
                <div class="d-flex justify-center">
                  <img src="{{asset('frontend/')}}/img/clients/4.svg" alt="image">
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>