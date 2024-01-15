<div>
    <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
      <h3 class="font-medium text-black dark:text-white">
       Update Booking
      </h3>
    </div>

      @if (session('error'))
        <div class="w-full">
          <h6 class="mb-3 text-lg font-bold text-red dark:text-[#ad0c16]" style="color: red;">
            {{ session('error') }}
          </h6> 
        </div> 
      @endif
    <div class="p-7">     

    <div class="border-b border-stroke py-4 mb-3 dark:border-strokedark">
      <h2 class="font-medium text-black dark:text-white">
       Personal Details
      </h2>
    </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Name</label>
              <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Name" wire:model.live="name" id="name" required >
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Email</label>
              <input type="email" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Email" wire:model.live="email" id="email" required >
              <x-input-error class="mt-2" :messages="$errors->get('email')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Number</label>
              <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Mobile Number" wire:model.live="mobile_no" id="mobile_no" required >
              <x-input-error class="mt-2" :messages="$errors->get('mobile_no')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Address</label>
              <textarea  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="address" id="address" required autofocus autocomplete="address" placeholder="Address">
            </textarea>
              <x-input-error class="mt-2" :messages="$errors->get('address')" />
          </div>
        </div>        

    <div class="border-b border-stroke py-4 mb-3 dark:border-strokedark">
      <h2 class="font-medium text-black dark:text-white">
       Booking Details
      </h2>
    </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Booking Name</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="booking_name" id="booking_name" placeholder="Booking Name" required >
              <x-input-error class="mt-2" :messages="$errors->get('booking_name')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Booking For</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="booking_for" id="booking_for" required placeholder="Booking For" >
              <x-input-error class="mt-2" :messages="$errors->get('booking_for')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Plan</label>
            <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="plan_id" id="plan_id" required autofocus autocomplete="plan_id">
              <option  value="">Select Plan</option>
              @if(isset($planList) && !empty($planList))
                @foreach($planList as $planKey => $planValue)
                  <option value="{{$planKey}}"> {{$planValue['plan_name']}}</option>
                @endforeach
              @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('plan_id')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Start Date</label>
              <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="start_date" id="start_date" required  wire:change="getTotalAmount()">
              <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">End Date</label>
              <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="end_date" id="end_date" required  wire:change="getTotalAmount()">
              <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Start Time</label>
              <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="start_time" id="start_time" required autofocus autocomplete="start_time" wire:change="getTotalAmount()">
                <option value="">Select Start Time</option>
                @if(isset($bookingTime) && !empty($bookingTime))
                  @foreach($bookingTime as $timeKey => $selectVlaue)
                    <option value="{{$timeKey}}" @if(isset($start_time) && $start_time == $selectVlaue) selected @endif> {{$selectVlaue}}</option>
                  @endforeach
                @endif
              </select>
                <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">End Time</label>
              <select  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="end_time" id="end_time" required autofocus autocomplete="end_time" wire:change="getTotalAmount()">
                <option  value="">Select End Time</option>
                @if(isset($bookingTime) && !empty($bookingTime))
                  @foreach($bookingTime as $timeKey => $selectVlaue)
                    <option value="{{$timeKey}}" @if(isset($end_time) && $end_time == $selectVlaue) selected @endif> {{$selectVlaue}}</option>
                  @endforeach
                @endif
              </select>
                <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
          </div>
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Remark's</label>
            <textarea  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="plan_description" id="plan_description" required autofocus autocomplete="plan_description" placeholder="Plan Description">
            </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('plan_description')" />
          </div>
        </div>

        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress"> <br> Bookin Amount </br></label>
            <input type="number" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="booking_amount" id="booking_amount" required >
              <x-input-error class="mt-2" :messages="$errors->get('booking_amount')" />
          </div>
        </div>

        <div class="border-b border-stroke py-4 mb-3 dark:border-strokedark">
          <h2 class="font-medium text-black dark:text-white">
           Detail of all the TEAM who is going to be there during the shoot with their contact numbers.
          </h2>
        </div>

        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Team Name</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="team_name" id="team_name" placeholder="Team Name" required >
              <x-input-error class="mt-2" :messages="$errors->get('team_name')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Team Contact</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="team_contact" id="team_contact" required placeholder="Team Contact" >
              <x-input-error class="mt-2" :messages="$errors->get('team_contact')" />
          </div>
        </div>

        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Photographer</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="photographer" id="photographer" placeholder="Photographer" required >
              <x-input-error class="mt-2" :messages="$errors->get('photographer')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Photographer's Assistant</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="photographer_assistant" id="photographer_assistant" required placeholder="Photographer's Assistant" >
              <x-input-error class="mt-2" :messages="$errors->get('photographer_assistant')" />
          </div>
        </div>

        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Cinematographer</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="cinematographer" id="cinematographer" placeholder="Cinematographer" required >
              <x-input-error class="mt-2" :messages="$errors->get('cinematographer')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Cinematographer's Assistant</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="cinematographer_assistant" id="cinematographer_assistant" required placeholder="Cinematographer's Assistant" >
              <x-input-error class="mt-2" :messages="$errors->get('cinematographer_assistant')" />
          </div>
        </div>

        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Models</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="models" id="model" placeholder="Models" required >
              <x-input-error class="mt-2" :messages="$errors->get('models')" />
            </div>
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Makeup Artist</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="makeup_artist" id="makeup_artist" placeholder="Makeup Artist" required >
              <x-input-error class="mt-2" :messages="$errors->get('makeup_artist')" />
            </div>
        </div>


        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
            <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Makeup Assitants</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="makeup_ssitants" id="makeup_ssitants" placeholder="Makeup Assitants" required >
              <x-input-error class="mt-2" :messages="$errors->get('makeup_ssitants')" />
            </div>
            <div class="w-full sm:w-1/2">
            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Hair Stylist</label>
            <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="hair_stylist" id="hair_stylist" required placeholder="Hair Stylist" >
              <x-input-error class="mt-2" :messages="$errors->get('hair_stylist')" />
          </div>
        </div>
        <div class=" flex flex-col gap-5.5 sm:flex-row mb-2">
          
          <div class="w-full sm:w-1/2">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white"
            for="emailAddress">Dress Des.</label>
              <textarea  class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="dress_des" id="dress_des" required autofocus autocomplete="dress_des" placeholder="Dress Des.">
            </textarea>
              <x-input-error class="mt-2" :messages="$errors->get('dress_des')" />
            </div>
        </div>

        <div class="flex justify-end gap-4.5">
          <button
            class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
            type="button" wire:click="cancel()">
            Cancel
          </button>
          <button
            class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
            type="button" wire:click="update()">
            update 
          </button>
        </div>
    </div>
</div>