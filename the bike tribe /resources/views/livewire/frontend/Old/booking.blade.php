<div>

  <div class="wpb_column vc_column_container vc_col-sm-12 vc_row-6483db9ac5ea0">
    <div class="vc_column-inner ">
      <div class="wpb_wrapper">
        <div class="wpb_raw_code wpb_content_element wpb_raw_html">
          <div class="wpb_wrapper">

            <div class="wpcf7 no-js" id="wpcf7-f7366-p1485-o1" lang="en-US" dir="ltr">
              <div class="screen-reader-response">
                @if (session('error'))
                  <p role="status" aria-live="polite" aria-atomic="true" style="color:red;">{{ session('error') }}</p>
                @endif
                <ul></ul>
              </div>
                <div id="two-column">
                  <div id="left">
                    <p>Name
                      <span class="wpcf7-form-control-wrap" data-name="booking-date"><input
                          class="wpcf7-form-control wpcf7-date wpcf7-validates-as-required wpcf7-validates-as-date"
                          aria-required="true" aria-invalid="false" value="" type="text" wire:model.live="name" name="name">
                          @error('name')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                      
                    </p>
                    <p>Contact Number
                      <span class="wpcf7-form-control-wrap" data-name="contact-number"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel"
                          aria-required="true" aria-invalid="false" value="" type="tel" wire:model.live="mobile_no" name="mobile_no">

                          @error('mobile_no')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                  </div>
                  
                  <div id="right">
                    <p>Email
                      <span class="wpcf7-form-control-wrap" data-name="email"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                          aria-required="true" aria-invalid="false" value="" wire:model.live="email" type="email" name="email">

                          @error('email')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                    <p>Booking Name (Person / Company / Organization)
                      <span class="wpcf7-form-control-wrap" data-name="name"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="text" wire:model.live="booking_name" name="booking_name">
                        @error('booking_name')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                  </div>
                  
                </div>
                <div id="two-column">
                  <div id="left">
                    
                    <p>Booking For
                      <span class="wpcf7-form-control-wrap" data-name="booking-for"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="text" wire:model.live="booking_for" name="booking_for">
                          @error('booking_for')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                    <p>Address
                      <span class="wpcf7-form-control-wrap" data-name="your-address"><textarea cols="40" rows="5"
                          class="wpcf7-form-control wpcf7-textarea" name="address" wire:model.live="address" aria-invalid="false"></textarea>
                        @error('address')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span>
                    </p>
                  </div>
                  <div id="right">
                    <p>Plan
                      <span class="wpcf7-form-control-wrap" data-name="booking-amount">
                        <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false"
                          wire:model.live="plan_id" id="plan_id" required autofocus autocomplete="plan_id">
                          <option value="">Select Plan</option>
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
                    <p>Remark 
                      <span class="wpcf7-form-control-wrap" data-name="booking-amount"><textarea cols="40" rows="5"
                          class="wpcf7-form-control wpcf7-textarea" name="plan_description" wire:model.live="plan_description" aria-invalid="false"></textarea>
                          @error('plan_description')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                  </div>
                </div>
                <div  id="two-column"> 
                  <div id="left">
                    <p>Start Date
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="date" wire:model.live="start_date" name="start_date" wire:change="getTotalAmount()">
                      @error('start_date')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                    <p>End Date
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" value="" type="date" wire:model.live="end_date" name="end_date" wire:change="getTotalAmount()">
                      @error('end_date')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror</span>
                    </p>
                  </div>
                  <div id="right">
                    <p>Start Time
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><select
                          class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" wire:model.live="start_time" name="start_time" wire:change="getTotalAmount()">
                          @if(isset($bookingTime) && !empty($bookingTime))
                            @foreach($bookingTime as $timeKey => $selectVlaue)
                            <option value="{{$timeKey}}" @if(isset($start_time) && $start_time==$selectVlaue) selected @endif>
                              {{$selectVlaue}}</option>
                            @endforeach
                          @endif
                        </select></span>
                    </p>
                    <p>End Date
                      <span class="wpcf7-form-control-wrap" data-name="time-slot"><select
                          class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" wire:model.live="end_time" name="end_time" wire:change="getTotalAmount()">
                          @if(isset($bookingTime) && !empty($bookingTime))
                            @foreach($bookingTime as $timeKey => $selectVlaue)
                            <option value="{{$timeKey}}" @if(isset($start_time) && $start_time==$selectVlaue) selected @endif>
                              {{$selectVlaue}}</option>
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
                <div id="two-column">
                  <div id="right">
                    <p>Booking Amount <span class="wpcf7-form-control-wrap" data-name="team-name"><input size="40"
                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                          aria-invalid="false" type="text" wire:model.live="booking_amount" name="booking_amount" readonly>
                            @error('booking_amount')
                          <span class="wpcf7-not-valid-tip" aria-hidden="true" style="color:red;">{{$message}}</span>
                          @enderror
                        </span></p>
                  </div>
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
                  <div id="left">
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
                  <div id="right">
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
                  <div id="left">
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
                  <div id="right">
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
                  <p style="margin-left: 20px;"><input class="wpcf7-form-control has-spinner wpcf7-submit mr-4" type="submit" wire:click="update" value="Submit"></p>
                </div>
                <div class="wpcf7-response-output" aria-hidden="true"></div>
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
              showCancelButton:true,
            });
        });
    </script>
</div>