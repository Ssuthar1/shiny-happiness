<x-front-app-layout> 
    <section data-anim="fade" class="d-flex items-center py-15 border-top-light">
      <div class="container">
        <div class="row y-gap-10 items-center justify-between">
          <div class="col-auto">
            <div class="row x-gap-10 y-gap-5 items-center text-14 text-light-1">
              <div class="col-auto">
                <div class=""><a href="{{route('homePage')}}">Home</a></div>
              </div>
              <div class="col-auto">
                <div class="">></div>
              </div>
              <div class="col-auto">
                <div class="">Blog</div>
              </div> 
            </div>
          </div>

          <div class="col-auto">
            <a href="#" class="text-14 text-light-1">London Tourism: Best of London</a>
          </div>
        </div>
      </div>
    </section>

    <section data-anim="slide-up delay-1" class="layout-pt-md">
      <div class="container">
        <div class="row justify-center text-center">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Travel articles</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0">Lorem ipsum is placeholder text commonly used in site.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section data-anim="slide-up delay-2" class="layout-pt-md layout-pb-lg">
      <div class="container">
        <div class="row y-gap-30 justify-between">
          <div class="col-xl-8">
            <div class="row y-gap-30">
              @for($count=1;$count<=5;$count++)
              <a href="{{route('postDetail','award-winning-resort')}}" class="blogCard -type-1 col-12">
                <div class="row y-gap-15 items-center md:justify-center md:text-center">
                  <div class="col-auto">
                    <div class="blogCard__image rounded-4">
                      <div class="ratio ratio-1:1 w-250">
                        <img src="{{asset('frontend/')}}/img/blog/list-2/1.png" alt="image" class="img-ratio rounded-4">
                      </div>
                    </div>
                  </div>

                  <div class="col-md">
                    <div class="text-15 text-light-1">April 06, 2022</div>

                    <h3 class="text-22 text-dark-1 mt-10 md:mt-5">
                      9 Award-Winning Ski Resorts Near Salt Lake City
                    </h3>

                    <div class="text-15 lh-16 text-light-1 mt-10 md:mt-5">For decades, travelers have been escaping to the Catskills — a mountainous region in upstate New York — whenever they’ve needed a reset. </div>
                  </div>
                </div>
              </a>
              @endfor
               
 

            </div>

            <div class="border-top-light mt-30 pt-30">
              <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                <div class="col-auto md:order-1">
                  <button class="button -blue-1 size-40 rounded-full border-light">
                    <i class="icon-chevron-left text-12"></i>
                  </button>
                </div>

                <div class="col-md-auto md:order-3">
                  <div class="row x-gap-20 y-gap-20 items-center md:d-none">

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">1</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">3</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-light-2">4</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">5</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">...</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">20</div>

                    </div>

                  </div>

                  <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">1</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">3</div>

                    </div>

                  </div>

                  <div class="text-center mt-30 md:mt-10">
                    <div class="text-14 text-light-1">1 – 20 of 300+ blog posts found</div>
                  </div>
                </div>

                <div class="col-auto md:order-2">
                  <button class="button -blue-1 size-40 rounded-full border-light">
                    <i class="icon-chevron-right text-12"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3">
            <div data="slide-up%20delay-3.html" class="sidebar -blog">
              <div class="sidebar__item -no-border">
                <h5 class="text-18 fw-500 mb-10">Search</h5>
                <div class="single-field relative d-flex items-center py-10">
                  <input class="pl-50 border-light text-dark-1 h-50 rounded-8" type="email" placeholder="Search">
                  <button class="absolute d-flex items-center h-full">
                    <i class="icon-search text-20 px-15 text-dark-1"></i>
                  </button>
                </div>
              </div>

              <div class="sidebar__item">
                <h5 class="text-18 fw-500 mb-10">Categories</h5>

                <div class="y-gap-5">

                  <a class="d-flex items-center justify-between text-dark-1" href="#">
                    <span class="text-15 text-dark-1">Hotel</span>
                    <span class="text-14 text-light-1">92</span>
                  </a>

                  <a class="d-flex items-center justify-between text-dark-1" href="#">
                    <span class="text-15 text-dark-1">Car</span>
                    <span class="text-14 text-light-1">92</span>
                  </a>

                  <a class="d-flex items-center justify-between text-dark-1" href="#">
                    <span class="text-15 text-dark-1">Holiday Rental</span>
                    <span class="text-14 text-light-1">92</span>
                  </a>

                  <a class="d-flex items-center justify-between text-dark-1" href="#">
                    <span class="text-15 text-dark-1">Travel Guides</span>
                    <span class="text-14 text-light-1">92</span>
                  </a>

                  <a class="d-flex items-center justify-between text-dark-1" href="#">
                    <span class="text-15 text-dark-1">Flights</span>
                    <span class="text-14 text-light-1">92</span>
                  </a>

                </div>
              </div>

              <div class="sidebar__item">
                <h5 class="text-18 fw-500 mb-10">Recent Posts</h5>

                <div class="row y-gap-20 pt-10">

                  <div class="col-12">
                    <div class="d-flex items-center">
                      <img class="size-65 rounded-8" src="{{asset('frontend/')}}/img/blog/sidebar/1.png" alt="image">
                      <div class="ml-15">
                        <h5 class="text-15 lh-15 fw-500">Find the Right Learning Path for your</h5>
                        <div class="text-13 lh-1 mt-5">April 13, 2022</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="d-flex items-center">
                      <img class="size-65 rounded-8" src="{{asset('frontend/')}}/img/blog/sidebar/2.png" alt="image">
                      <div class="ml-15">
                        <h5 class="text-15 lh-15 fw-500">Find the Right Learning Path for your</h5>
                        <div class="text-13 lh-1 mt-5">April 13, 2022</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="d-flex items-center">
                      <img class="size-65 rounded-8" src="{{asset('frontend/')}}/img/blog/sidebar/3.png" alt="image">
                      <div class="ml-15">
                        <h5 class="text-15 lh-15 fw-500">Find the Right Learning Path for your</h5>
                        <div class="text-13 lh-1 mt-5">April 13, 2022</div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="sidebar__item">
                <h5 class="text-18 fw-500 mb-10">Tags</h5>

                <div class="row x-gap-10 y-gap-10 pt-10">

                  <div class="col-auto">
                    <a href="#" class="button -blue-1 py-5 px-20 bg-blue-1-05 rounded-100 text-15 fw-500 text-blue-1">Museum</a>
                  </div>

                  <div class="col-auto">
                    <a href="#" class="button -blue-1 py-5 px-20 bg-blue-1-05 rounded-100 text-15 fw-500 text-blue-1">Park</a>
                  </div>

                  <div class="col-auto">
                    <a href="#" class="button -blue-1 py-5 px-20 bg-blue-1-05 rounded-100 text-15 fw-500 text-blue-1">Beach</a>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="layout-pt-md layout-pb-md bg-dark-2">
      <div class="container">
        <div class="row y-gap-30 justify-between items-center">
          <div class="col-auto">
            <div class="d-flex y-gap-20 flex-wrap items-center">
              <div class="icon-newsletter text-60 sm:text-40 text-white"></div>

              <div class="ml-30">
                <h4 class="text-26 text-white fw-600">Your Travel Journey Starts Here</h4>
                <div class="text-white">Sign up and we'll send the best deals to you</div>
              </div>
            </div>
          </div>

          <div class="col-auto">
            <div class="single-field d-flex x-gap-10 y-gap-20">
              <div>
                <input class="bg-white h-60" type="text" placeholder="Your Email">
              </div>

              <div>
                <button class="button -md h-60 bg-blue-1 text-white">Subscribe</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</x-front-app-layout>