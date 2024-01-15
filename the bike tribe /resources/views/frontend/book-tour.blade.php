 <x-front-app-layout> 

    <section class="py-10 d-flex items-center bg-light-2">
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
                <div class="">Book Tour</div>
              </div> 
            </div>
          </div> 
        </div>
      </div>
    </section> 

    
   <section class="pt-40">
      <div class="container">

        <div class="col-xl-7 col-lg-8 offset-md-2">
            

            <h2 class="text-22 fw-500 mt-40 mb-20">DESIGNING YOUR PERFECT ADVENTURE</h2>
			
			<p>To help us help you create your perfect itinerary please answer the questions below. You can be as detailed as you like - or if you are not sure- we can send through a few suggestions. Check out our scheduled tours for ideas.</p>

<p>Why not use our extensive resource, local knowledge and 15 years of operational experience to take the pressure off you and let us create your perfect adventure?</p>

<p>Here are some initial questions to get you started. You can be as detailed as you like, or if you're not sure, we can send through a few suggestions. Alternatively, you may contact us by sending an email to custom@thebirketribe.com</p>

            <div class="row x-gap-20 y-gap-20 pt-20">
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Full Name</label>
                </div>

              </div>
			  <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Last Name</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Email</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Phone Number</label>
                </div>

              </div>
              <div class="col-6">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">Country Of Residence</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="United Kingdom">United Kingdom</div>
                  <div class="select__options__button" data-value="United States">United States</div>
                  <div class="select__options__button" data-value="Australia">Australia</div>
                  <div class="select__options__button" data-value="Germany">Germany</div>
                  <div class="select__options__button" data-value="France">France</div>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Name Of Your Organization (If Applicable)</label>
                </div>

              </div>
			  <div class="col-md-12">		
			  <label class="text-16 lh-1 fw-500 text-dark-1 mb-0">When Would You Like To Go?</label>
			  </div>
			  <div class="col-md-6">

                <div class="form-input ">
                  <input type="date" value="2017-06-01" />
                  <label class="lh-1 text-16 text-light-1">Start</label>
                </div>

              </div>
			  
			  <div class="col-md-6">

                <div class="form-input ">
                  <input type="date" value="2017-06-01" />
                  <label class="lh-1 text-16 text-light-1">End</label>
                </div>

              </div>
			  
			  
			  <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">How Many Riders In Your Group?</label>
                </div>

              </div>
			  
			  <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Where Would You Like To Visit?</label>
                </div>

              </div>
			  
			  <div class="col-12">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">What Style Of Accmmodation Would Suit Your?</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="Luxury">Luxury</div>
                  <div class="select__options__button" data-value="Resort">Resort</div>
                  <div class="select__options__button" data-value="Boutique">Boutique</div>
                  <div class="select__options__button" data-value="Authentic">Authentic</div>
                  <div class="select__options__button" data-value="Guesthouse">Guesthouse</div>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-12">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">How Challenging Would You Like The Tour?</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="Easy">Easy</div>
                  <div class="select__options__button" data-value="Leisure">Resort</div>
                  <div class="select__options__button" data-value="Moderate">Boutique</div>
                  <div class="select__options__button" data-value="Active">Authentic</div>
                  <div class="select__options__button" data-value="Hard">Guesthouse</div>
				  <div class="select__options__button" data-value="Hard">Extreme</div>
                </div>
              </div>
            </div>
          </div>
		  <div class="col-12">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">What Sort Of Distances Would You Like To Ride Daily?</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="Easy">Touring</div>
                  <div class="select__options__button" data-value="Leisure">Road</div>
                  <div class="select__options__button" data-value="Moderate">Trails</div>
                  <div class="select__options__button" data-value="Active">Epic</div>
                  <div class="select__options__button" data-value="Hard">Weekenders</div>
				  <div class="select__options__button" data-value="Hard">Day Tours</div>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-12">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">What Sort Of Distances Would You Like To Ride Daily?</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="Easy">up to 10km</div>
                  <div class="select__options__button" data-value="Leisure">11-20km</div>
                  <div class="select__options__button" data-value="Moderate">21-40km</div>
                  <div class="select__options__button" data-value="Active">40-60km</div>
                  <div class="select__options__button" data-value="Hard">61-80km</div>
				  <div class="select__options__button" data-value="Hard">81-100km</div>
				  <div class="select__options__button" data-value="Hard">121-150km</div>
				  
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-12">
	            <div class="select js-select js-liveSearch" data-select-value="">
              <button class="select__button js-button">
                <span class="js-button-title">Are There any other activities you would like to include on the tour?</span>
                <i class="select__icon" data-feather="chevron-down"></i>
              </button>

              <div class="select__dropdown js-dropdown">
                <input type="text" placeholder="Search" class="select__search js-search">

                <div class="select__options js-options">
                  <div class="select__options__button" data-value="Easy">Trekking</div>
                  <div class="select__options__button" data-value="Leisure">Snorkeling/Diving</div>
                  <div class="select__options__button" data-value="Moderate">Ethical Elephant Encounters</div>
                  <div class="select__options__button" data-value="Active">Rafting</div>
                  <div class="select__options__button" data-value="Hard">Kayaking</div>
				  <div class="select__options__button" data-value="Hard">Zipline</div>
				  <div class="select__options__button" data-value="Hard">Cooking Class</div>
				  
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-12">

                <div class="form-input ">
                  <input type="text" required="">
                  <label class="lh-1 text-16 text-light-1">Others</label>
                </div>

              </div>
			  
			  <div class="col-12">

                <div class="form-input ">
                  <textarea required="" rows="6"></textarea>
                  <label class="lh-1 text-16 text-light-1">Special Requests</label>
                </div>

              </div>
			  <div class="col-12">
                <div class="row y-gap-20 items-center justify-between">
                  <div class="col-auto">
                    <div class="text-14 text-light-1">
                      By proceeding with this booking, I agree to The Bike Tribe Terms of Use and Privacy Policy.
                    </div>
                  </div>

                  <div class="col-auto">

                    <a href="#" class="button h-60 px-24 -dark-1 bg-blue-1 text-white">
                      Next: Final details <div class="icon-arrow-top-right ml-15"></div>
                    </a>

                  </div>
                </div>
              </div>

              </div>`
              
              
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

          <div class="col-auto">
            <div class="single-field -w-410 d-flex x-gap-10 y-gap-20">
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