<div>
<div class="heading-decor"><h1 class="h2">Booking</h1></div>
  <div class="wpb_column vc_column_container vc_col-sm-12 vc_row-6483db9ac5ea0">
    <div class="vc_column-inner ">
      <div class="wpb_wrapper">
        <div class="wpb_raw_code wpb_content_element wpb_raw_html">
          <div class="wpb_wrapper">

            <div class="wpcf7" dir="ltr">
              <div class="screen-reader-response">
                @if (session('error'))
                  <p  style="color:red;">{{ session('error') }}</p>
                @endif
                <ul></ul>
              </div>

                @if($pageType=='bookingConfirm')
                <h3 class="ml-4">Pay Now</h3>
                    <div class="clear"></div>
                     <div id="two-column" class="ml-4"> 
                     @if(!empty($booking_amount))
                       <div class="left_section"><br/><br/>
                        <h5>Booking ID <span class="wpcf7-form-control-wrap" > : </span><strong><span style="color: #ffcc00;"> {{$booking_id}} </span></strong></h5>
                    <h5>Total Booking Amount <span class="wpcf7-form-control-wrap" > : </span><strong><span style="color: #ffcc00;"> {{$booking_amount}} - INR</span> </strong></h5>
                  </div>
                  @endif
                </div> <div class="clear"></div>
                  <div wire:loading.remove>
                  <p style="margin-left: 20px;"><input class="wpcf7-form-control has-spinner wpcf7-submit mr-4" type="submit" wire:click="payNow()" value="Pay Now"></p></div>
                  <div wire:loading>
                     <p style="margin-left: 20px;"><input class="wpcf7-form-control has-spinner wpcf7-submit mr-4" type="submit"   value="Processing..."></p>
                  </div>
                @else
                <div id="two-column">
                    <h3 class="ml-4">Contact Information</h3>

                  <div class="left_section">
                       <p>Booking Name (Person / Company / Organization)
                      <span class="wpcf7-form-control-wrap" data-name="name"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="text" wire:model="booking_name" name="booking_name">
                        @error('booking_name')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                    <p>Contact Number
                      <span class="wpcf7-form-control-wrap" data-name="contact-number"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel"
                          aria-required="true" aria-invalid="false" value="" type="tel" wire:model="mobile_no" name="mobile_no">

                          @error('mobile_no')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                        <p>Address
                      <span class="wpcf7-form-control-wrap" data-name="your-address"><textarea cols="40" rows="5"
                          class="wpcf7-form-control wpcf7-textarea" name="address" wire:model="address" aria-invalid="false"></textarea>
                        @error('address')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                  </div>
                  
                  <div class="right_section">
                    <p>Email
                      <span class="wpcf7-form-control-wrap" data-name="email"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                          aria-required="true" aria-invalid="false" value="" wire:model="email" type="email" name="email">

                          @error('email')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                
                  </div>
                  
                </div>

                <div id="two-column">
                  <div class="left_section">
                    
                    <p>Booking For
                      <span class="wpcf7-form-control-wrap" data-name="booking-for"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="text" wire:model="booking_for" name="booking_for">
                          @error('booking_for')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                
                  </div>
                </div>
              <div class="clear"></div>
              <h3 class="ml-4">Booking Information</h3>
              <div id="two-column"> 
                  <div class="left_section">
                    <p>Select Plan  
                      <span class="wpcf7-form-control-wrap" data-name="plan_id">
                        <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false"
                          wire:model="plan_id" id="plan_id" required autofocus autocomplete="plan_id"  >
                          
                          @if(isset($planList) && !empty($planList))
                          @foreach($planList as $planKey => $planValue)
                          <option value="{{$planKey}}"> {{$planValue['plan_name']}}</option>
                          @endforeach
                          @endif
                        </select>
                        @error('plan_id')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                    
                  </div>
                </div><div class="clear"></div>
                <div  id="two-column"> 
                  <div class="left_section">
                    <p>Start Date
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="date" wire:model="start_date" name="start_date" >
                      @error('start_date')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                            @if (session('dateerror'))
                          <p  aria-live="polite" aria-atomic="true" style="color:red;">{{ session('dateerror') }}</p>
                        @endif
                    </p></div>
                    
                  
                  <div class="right_section">
                    <p>End Date
                      <span class="wpcf7-form-control-wrap" data-name="time-slot">

                        <input  
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"   type="date" wire:model="end_date" name="end_date"  >
                      @error('end_date')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p></div>
                    </div>
                    <div class="clear"></div>
                     <div  id="two-column"> 
                  <div class="left_section">
                    <p>Start Time
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><select
                          class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" wire:model="start_time" name="start_time" wire:change="getTotalAmount()">
                          @if(isset($bookingTime) && !empty($bookingTime))
                            @foreach($bookingTime as $timeKey => $selectVlaue)
                               @if($timeKey<=35)
                            <option value="{{$timeKey}}" @if(isset($start_time) && $start_time==$selectVlaue) selected @endif>
                              {{$selectVlaue}}</option>
                              @endif
                            @endforeach
                          @endif
                        </select></span>
                    </p></div>
                     <div class="right_section">
                    <p>End Time
                      <span class="wpcf7-form-control-wrap" data-name="end_time">
                        <select
                          class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"   wire:model="end_time" name="end_time"  >
                          @if(isset($bookingTime) && !empty($bookingTime))
                            @foreach($bookingTime as $timeKey => $selectVlaue)
                            @if($timeKey>4)
                            <option value="{{$timeKey}}" @if(isset($start_time) && $start_time==$selectVlaue) selected @endif>
                              {{$selectVlaue}}</option>
                              @endif
                            @endforeach
                          @endif
                        </select>
                        @if (session('error'))
                          <p role="status" aria-live="polite" aria-atomic="true" style="color:red;">{{ session('error') }}</p>
                        @endif
                      </span>
                    </p>
                  </div>
                </div>
                 <div class="clear"></div>
                <div id="two-column"> 
                    <p>Message for us 
                      <span class="wpcf7-form-control-wrap" data-name="booking-amount"><textarea cols="40" rows="5"
                          class="wpcf7-form-control wpcf7-textarea" name="plan_description" wire:model="plan_description" aria-invalid="false"></textarea>
                          @error('plan_description')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p> </div>
                    <div id="two-column"> 
                     @if(!empty($booking_amount))
                       <div class="left_section"><br/><br/>
                    <p>Total Booking Amount <span class="wpcf7-form-control-wrap" data-name="team-name"> : </span><strong> {{$booking_amount}} - INR </strong></p>
                  </div>
                  @endif
                </div>
                <!-- <div class="clear"></div>
                <div id="two-column">
                  <p>Mode Of Payment - <span class="wpcf7-form-control-wrap" data-name="radio-681"><span
                        class="wpcf7-form-control wpcf7-radio"><span class="wpcf7-list-item first"><input type="radio"
                            name="radio-681" value="UPI" checked="checked"><span
                            class="wpcf7-list-item-label">UPI</span></span><span class="wpcf7-list-item"><input
                            type="radio" name="radio-681" value="Cash"><span
                            class="wpcf7-list-item-label">Cash</span></span><span class="wpcf7-list-item last"><input
                            type="radio" name="radio-681" value="Debit / Credit Card"><span
                            class="wpcf7-list-item-label">Debit / Credit Card</span></span></span></span></p>
                  <p><strong>Detail of all the TEAM who is going to be there during the shoot with their contact
                      numbers.</strong></p>
                  <div class="left_section">
                    <p>Team Name <span class="wpcf7-form-control-wrap" data-name="team-name"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="text" name="team-name"></span></p>
                    <p>Photographer
                      <span class="wpcf7-form-control-wrap" data-name="photographer-name"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="photographer-name"></span>
                    </p>
                    <p>Cinematographer
                      <span class="wpcf7-form-control-wrap" data-name="cinematographer-name"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="cinematographer-name"></span>
                    </p>
                  </div>
                  <div class="right_section">
                    <p>Team Contact <span class="wpcf7-form-control-wrap" data-name="teamcontact-number"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel"
                          aria-required="true" aria-invalid="false" value="" type="tel" name="teamcontact-number"></span>
                    </p>
                    <p>Photographer's Assistant
                      <span class="wpcf7-form-control-wrap" data-name="photographer-assistant"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="photographer-assistant"></span>
                    </p>
                    <p>Cinematographer's Assistant
                      <span class="wpcf7-form-control-wrap" data-name="cinematographer-assistant"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="cinematographer-assistant"></span>
                    </p>
                    <p></p>
                  </div>
                  <div class="left_section">
                    <p>Models
                      <span class="wpcf7-form-control-wrap" data-name="model-name"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="model-name"></span>
                    </p>
                    <p>Makeup Artist
                      <span class="wpcf7-form-control-wrap" data-name="makeup-artist"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="makeup-artist"></span>
                    </p>
                    <p>Dress des
                      <span class="wpcf7-form-control-wrap" data-name="dress-des"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="dress-des"></span>
                    </p>
                  </div>
                  <div class="right_section">
                    <p>Makeup Assitants
                      <span class="wpcf7-form-control-wrap" data-name="makeup-assitants"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="makeup-assitants"></span>
                    </p>
                    <p>Hair Stylist
                      <span class="wpcf7-form-control-wrap" data-name="hair-stylist"><input size="40"
                          class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text"
                          name="hair-stylist"></span>
                    </p>
                  </div> -->
                  <div class="clear"></div>
                  <div wire:loading.remove>
                  <p style="margin-left: 20px;"><input class="wpcf7-form-control has-spinner wpcf7-submit mr-4" type="submit" wire:click="bookNow()" value="Book Now"></p></div>
                  <div wire:loading>
                     <p style="margin-left: 20px;"><input class="wpcf7-form-control has-spinner wpcf7-submit mr-4" type="submit"   value="Processing..."></p>
                    </div>
                </div>
                <div class="wpcf7-response-output" aria-hidden="true"></div>
              </div>
              @endif 

              <div class="ml-4">
                <h3>Terms & Conditions:</h3>
                <ol>
                  <li>For Booking, you need to pay 100% advance, and a minimum of TWO hours booking charges are applicable. After Two hours of booking minimum half-hour charges are applicable. You can pay by <span style="color: #ffcc00;">cash at Studio or Paytm or <strong>Google Pay on this no. 9887229711</strong></span> or transfer to the company account. 18% GST extra if you need an invoice. <br>
 <span style="color: #ffcc00;">Account name: Khammaa Ghani Moving Images <br>
A/No. 912020041566736 <br>
IFSC: UTIB0000311</span></li>
<li>After Payment confirmation booking confirmation will be texted on WhatsApp. In case of booking cancellation. only 50% will be refundable of paid booking amount.</li>
<li>Any damage to booked premises has to be covered by the person who booked it.</li>
<li>Your booking time shall start as your booked time slot, reaching late at the premises will not add up extra time in any case, and reaching early at the premises and starting shooting before the time slot will automatically shift the time slot at the time you had started using the premises.</li>
<li>Your session time starts from the BOOKED time and ends when the last person of your crew leaves the studio.</li>
<li>Backdrop Damage Any Damage TO the backdrop OR ANY OTHER THING will payable to the client who booked the studio as per Paper Backdrop – INR. 1500.</li>
<li>In case of electricity failure or any other delay from the studio side that happens during the shoot then the studio shall compensate for the same accordingly by providing extra time without any extra charges.</li>
<li>If we already have a booking after your time slot then you must vacate the place within 15 minutes and if we do not have any other booking after your time slot is over and you need to extend your shoot then you can pay and extend it as per your requirement and minimum half an hour booking is mandatory.</li>
<li>Any dispute needs to be deal with under Jaipur’s jurisdiction.</li>
                </ol>
              </div>
              <hr>
              <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
 <div class="ml-4">
                <h3>Studio Rules:</h3>
                <ul>
                  <li>PETS NOT allowed inside the studio</li>
                  <li>Eatables & Drinks NOT allowed near Backdrop</li>
                  <li>Smoking & Alcohol are NOT Allowed inside the studio</li>
                  <li>Only INDIVIDUALS related to photoshoots are allowed inside the studio.</li>
                </ul>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>  
        window.addEventListener('swal:confirm', event => { 
            Swal.fire({
              title: event.detail.message,
              text: event.detail.text,
              icon: event.detail.type,
              showCancelButton:false,
            });
        });
    </script>
</div>