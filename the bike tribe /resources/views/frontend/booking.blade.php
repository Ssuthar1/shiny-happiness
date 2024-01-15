 <x-front-app-layout> 

    <section class="pt-40">
      <div class="container">
        <div class="row x-gap-40 y-gap-30 items-center">
          <div class="col-auto">
            <div class="d-flex items-center">
              <div class="size-40 rounded-full flex-center bg-blue-1">
                <i class="icon-check text-16 text-white"></i>
              </div>
              <div class="text-18 fw-500 ml-10">Your selection</div>
            </div>
          </div>

          <div class="col">
            <div class="w-full h-1 bg-border"></div>
          </div>

          <div class="col-auto">
            <div class="d-flex items-center">
              <div class="size-40 rounded-full flex-center bg-blue-1-05 text-blue-1 fw-500">2</div>
              <div class="text-18 fw-500 ml-10">Your details</div>
            </div>
          </div>

          <div class="col">
            <div class="w-full h-1 bg-border"></div>
          </div>

          <div class="col-auto">
            <div class="d-flex items-center">
              <div class="size-40 rounded-full flex-center bg-blue-1-05 text-blue-1 fw-500">3</div>
              <div class="text-18 fw-500 ml-10">Final step</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="pt-40 layout-pb-md">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-lg-8">
            <div class="py-15 px-20 rounded-4 text-15 bg-blue-1-05">
              Sign in to book with your saved details or
              <a href="#" class="text-blue-1 fw-500">register</a>
              to manage your bookings on the go!
            </div>

            <h2 class="text-22 fw-500 mt-40 md:mt-24">Let us know who you are</h2>

            <div class="row x-gap-20 y-gap-20 pt-20">
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Full Name</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Email</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Phone Number</label>
                </div>

              </div>
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Address line 1</label>
                </div>

              </div>
              <div class="col-12">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Address line 2</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">State/Province/Region</label>
                </div>

              </div>
              <div class="col-md-6">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">ZIP code/Postal code</label>
                </div>

              </div>

              <div class="col-12">

                <div class="form-input ">
                  <textarea required rows="6"></textarea>
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
            </div>

            <div class="row y-gap-30 pt-40">
              <div class="col-12">
                <div class="px-24 py-20 rounded-4 bg-green-1">
                  <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                      <div class="flex-center size-60 rounded-full bg-white">
                        <i class="icon-star text-yellow-1 text-30"></i>
                      </div>
                    </div>

                    <div class="col-auto">
                      <h4 class="text-18 lh-15 fw-500">This property is in high demand!</h4>
                      <div class="text-15 lh-15">7 travelers have booked today.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row y-gap-30 pt-10">
              <div class="col-12">
                <div class="px-24 py-20 rounded-4 bg-light-2">
                  <div class="row x-gap-20 y-gap-20 items-center">
                    <div class="col-auto">
                      <div class="flex-center size-60 rounded-full bg-white">
                        <i class="icon-star text-yellow-1 text-30"></i>
                      </div>
                    </div>

                    <div class="col-auto">
                      <h4 class="text-18 lh-15 fw-500">Limited supply in London for your dates:</h4>
                      <div class="text-15 lh-15">27 four-star hotels like this are already unavailable on our site</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-40">
              <h3 class="text-22 fw-500 mb-20">How do you want to pay?</h3>

              <div class="row y-gap-20 x-gap-20">
                <div class="col-auto">
                  <button class="button -dark-1 bg-blue-1 text-white px-20 py-15">Credit/Debit Card</button>
                </div>

                <div class="col-auto">
                  <button class="button -blue-1 bg-light-2 px-20 py-15">Digital Payment</button>
                </div>
              </div>

              <div class="row x-gap-20 y-gap-20 pt-20">
                <div class="col-12">

                  <div class="form-input ">
                    <input type="text" required>
                    <label class="lh-1 text-16 text-light-1">Select payment method *</label>
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-input ">
                    <input type="text" required>
                    <label class="lh-1 text-16 text-light-1">Card holder name *</label>
                  </div>


                  <div class="form-input mt-20">
                    <input type="text" required>
                    <label class="lh-1 text-16 text-light-1">Credit/debit card number *</label>
                  </div>


                  <div class="row x-gap-20 y-gap-20 pt-20">
                    <div class="col-md-6">

                      <div class="form-input ">
                        <input type="text" required>
                        <label class="lh-1 text-16 text-light-1">Expiry date *</label>
                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <input type="text" required>
                        <label class="lh-1 text-16 text-light-1">CVC/CVV *</label>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <img src="{{asset('frontend/')}}/img/booking-pages/card.png" alt="image" class="h-full">
                </div>
              </div>
            </div>

            <div class="mt-60 md:mt-32">
              <div class="row y-gap-20 x-gap-20">
                <div class="col-auto">
                  <button class="button -dark-1 bg-blue-1 text-white px-20 py-15">Credit/Debit Card</button>
                </div>

                <div class="col-auto">
                  <button class="button -blue-1 bg-light-2 px-20 py-15">Digtal Payment</button>
                </div>
              </div>

              <div class="mt-20">

                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Select payment method *</label>
                </div>

              </div>

              <div class="mt-20">
                <ul class="list-disc y-gap-4 text-15 text-light-1">
                  <li>You have chosen to pay by PayPal. You will be forwarded to the PayPal website to proceed with this transaction.</li>
                  <li>The total amount you will be charged is: $2,338.01</li>
                </ul>
              </div>
            </div>

            <div class="w-full h-1 bg-border mt-40 mb-40"></div>

            <div class="row y-gap-20 items-center justify-between">
              <div class="col-auto">

                <div class="d-flex items-center">
                  <div class="form-checkbox ">
                    <input type="checkbox" name="name">
                    <div class="form-checkbox__mark">
                      <div class="form-checkbox__icon icon-check"></div>
                    </div>
                  </div>

                  <div class="text-14 lh-10 text-light-1 ml-10">Get access to members-only deals, just like the millions of other email subscribers</div>

                </div>

              </div>

              <div class="col-auto">

                <a href="#" class="button h-60 px-24 -dark-1 bg-blue-1 text-white">
                  Book Now <div class="icon-arrow-top-right ml-15"></div>
                </a>

              </div>
            </div>

            <div class="d-flex flex-column items-center mt-60 lg:md-40 sm:mt-24">
              <div class="size-80 flex-center rounded-full bg-dark-3">
                <i class="icon-check text-30 text-white"></i>
              </div>

              <div class="text-30 lh-1 fw-600 mt-20">System, your order was submitted successfully!</div>
              <div class="text-15 text-light-1 mt-10">Booking details has been sent to: admin@bookingcore.test</div>
            </div>

            <div class="border-type-1 rounded-8 px-50 py-35 mt-40">
              <div class="row">

                <div class="col-lg-3 col-md-6">
                  <div class="text-15 lh-12">Order Number</div>
                  <div class="text-15 lh-12 fw-500 text-blue-1 mt-10">13119</div>
                </div>

                <div class="col-lg-3 col-md-6">
                  <div class="text-15 lh-12">Date</div>
                  <div class="text-15 lh-12 fw-500 text-blue-1 mt-10">27/07/2021</div>
                </div>

                <div class="col-lg-3 col-md-6">
                  <div class="text-15 lh-12">Total</div>
                  <div class="text-15 lh-12 fw-500 text-blue-1 mt-10">$40.10</div>
                </div>

                <div class="col-lg-3 col-md-6">
                  <div class="text-15 lh-12">Payment Method</div>
                  <div class="text-15 lh-12 fw-500 text-blue-1 mt-10">Direct Bank Transfer</div>
                </div>

              </div>
            </div>

            <div class="border-light rounded-8 px-50 py-40 mt-40">
              <h4 class="text-20 fw-500 mb-30">Your Information</h4>

              <div class="row y-gap-10">

                <div class="col-12">
                  <div class="d-flex justify-between ">
                    <div class="text-15 lh-16">First name</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">System</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Last name</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">Admin</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Email</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">admin@bookingcore.test</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Phone</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">112 666 888</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Address line 1</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1"></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Address line 2</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1"></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">City</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">New York</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">State/Province/Region</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1"></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">ZIP code/Postal code</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1"></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Country</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1">United States</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-between border-top-light pt-10">
                    <div class="text-15 lh-16">Special Requirements</div>
                    <div class="text-15 lh-16 fw-500 text-blue-1"></div>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="col-xl-5 col-lg-4">
            <div class="ml-80 lg:ml-40 md:ml-0">
              <div class="px-30 py-30 border-light rounded-4">
                <div class="text-20 fw-500 mb-30">Your booking details</div>

                <div class="row x-gap-15 y-gap-20">
                  <div class="col-auto">
                    <img src="{{asset('frontend/')}}/img/backgrounds/1.png" alt="image" class="size-140 rounded-4 object-cover">
                  </div>

                  <div class="col">
                    <div class="d-flex x-gap-5 pb-10">

                      <i class="icon-star text-yellow-1 text-10"></i>

                      <i class="icon-star text-yellow-1 text-10"></i>

                      <i class="icon-star text-yellow-1 text-10"></i>

                      <i class="icon-star text-yellow-1 text-10"></i>

                      <i class="icon-star text-yellow-1 text-10"></i>

                    </div>

                    <div class="lh-17 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</div>
                    <div class="text-14 lh-15 mt-5">Westminster Borough, London</div>

                    <div class="row x-gap-10 y-gap-10 items-center pt-10">
                      <div class="col-auto">
                        <div class="d-flex items-center">
                          <div class="size-30 flex-center bg-blue-1 rounded-4">
                            <div class="text-12 fw-600 text-white">4.8</div>
                          </div>

                          <div class="text-14 fw-500 ml-10">Exceptional</div>
                        </div>
                      </div>

                      <div class="col-auto">
                        <div class="text-14">3,014 reviews</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="border-top-light mt-30 mb-20"></div>

                <div class="row y-gap-20 justify-between">
                  <div class="col-auto">
                    <div class="text-15">Check-in</div>
                    <div class="fw-500">Thu 21 Apr 2022</div>
                    <div class="text-15 text-light-1">15:00 – 23:00</div>
                  </div>

                  <div class="col-auto md:d-none">
                    <div class="h-full w-1 bg-border"></div>
                  </div>

                  <div class="col-auto text-right md:text-left">
                    <div class="text-15">Check-out</div>
                    <div class="fw-500">Sat 30 Apr 2022</div>
                    <div class="text-15 text-light-1">01:00 – 11:00</div>
                  </div>
                </div>

                <div class="border-top-light mt-30 mb-20"></div>

                <div class="">
                  <div class="text-15">Total length of stay:</div>
                  <div class="fw-500">9 nights</div>
                  <a href="#" class="text-15 text-blue-1 underline">Travelling on different dates?</a>
                </div>

                <div class="border-top-light mt-30 mb-20"></div>

                <div class="row y-gap-20 justify-between items-center">
                  <div class="col-auto">
                    <div class="text-15">You selected:</div>
                    <div class="fw-500">Superior Double Studio</div>
                    <a href="#" class="text-15 text-blue-1 underline">Change your selection</a>
                  </div>

                  <div class="col-auto">
                    <div class="text-15">1 room, 4 adult</div>
                  </div>
                </div>
              </div>

              <div class="px-30 py-30 border-light rounded-4 mt-30">
                <div class="text-20 fw-500 mb-20">Your price summary</div>

                <div class="row y-gap-5 justify-between">
                  <div class="col-auto">
                    <div class="text-15">Superior Twin</div>
                  </div>
                  <div class="col-auto">
                    <div class="text-15">US$3,372.34</div>
                  </div>
                </div>

                <div class="row y-gap-5 justify-between pt-5">
                  <div class="col-auto">
                    <div class="text-15">Taxes and fees</div>
                  </div>
                  <div class="col-auto">
                    <div class="text-15">US$674.47</div>
                  </div>
                </div>

                <div class="row y-gap-5 justify-between pt-5">
                  <div class="col-auto">
                    <div class="text-15">Booking fees</div>
                  </div>
                  <div class="col-auto">
                    <div class="text-15">FREE</div>
                  </div>
                </div>

                <div class="px-20 py-20 bg-blue-2 rounded-4 mt-20">
                  <div class="row y-gap-5 justify-between">
                    <div class="col-auto">
                      <div class="text-18 lh-13 fw-500">Price</div>
                    </div>
                    <div class="col-auto">
                      <div class="text-18 lh-13 fw-500">US$4,046.81</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="px-30 py-30 border-light rounded-4 mt-30">
                <div class="text-20 fw-500 mb-20">Your payment schedule</div>

                <div class="row y-gap-5 justify-between">
                  <div class="col-auto">
                    <div class="text-15">Before you stay you'll pay</div>
                  </div>
                  <div class="col-auto">
                    <div class="text-15">US$4,047</div>
                  </div>
                </div>
              </div>

              <div class="px-30 py-30 border-light rounded-4 mt-30">
                <div class="text-20 fw-500 mb-15">Do you have a promo code?</div>


                <div class="form-input ">
                  <input type="text" required>
                  <label class="lh-1 text-16 text-light-1">Enter promo code</label>
                </div>


                <button class="button -outline-blue-1 text-blue-1 px-30 py-15 mt-20">Apply</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="layout-pt-md layout-pb-lg">
      <div class="container">
        <div class="row justify-center text-center">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Why Choose Us</h2>
              <p class=" sectionTitle__text mt-5 sm:mt-0">These popular destinations have a lot to offer</p>
            </div>
          </div>
        </div>

        <div class="row y-gap-40 justify-between pt-50">

          <div class="col-lg-3 col-sm-6">

            <div class="featureIcon -type-1 ">
              <div class="d-flex justify-center">
                <img src="#" data-src="{{asset('frontend/')}}/img/featureIcons/1/1.svg" alt="image" class="js-lazy">
              </div>

              <div class="text-center mt-30">
                <h4 class="text-18 fw-500">Best Price Guarantee</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>

          </div>

          <div class="col-lg-3 col-sm-6">

            <div class="featureIcon -type-1 ">
              <div class="d-flex justify-center">
                <img src="#" data-src="{{asset('frontend/')}}/img/featureIcons/1/2.svg" alt="image" class="js-lazy">
              </div>

              <div class="text-center mt-30">
                <h4 class="text-18 fw-500">Easy & Quick Booking</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>

          </div>

          <div class="col-lg-3 col-sm-6">

            <div class="featureIcon -type-1 ">
              <div class="d-flex justify-center">
                <img src="#" data-src="{{asset('frontend/')}}/img/featureIcons/1/3.svg" alt="image" class="js-lazy">
              </div>

              <div class="text-center mt-30">
                <h4 class="text-18 fw-500">Customer Care 24/7</h4>
                <p class="text-15 mt-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
