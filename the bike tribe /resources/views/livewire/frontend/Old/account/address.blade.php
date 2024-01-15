<div class="col-span-12 lg:col-span-9 box_shadow px-6 py-8">
            <div class="acprof_info_wrap shadow_sm">
                <h4 class="text-lg mb-3">Manage Address</h4>
                <form action="#">
                    <div>
                        <div class="sm:flex gap-6">
                            <div class="w-full">
                                <label>First Name</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="first_name" placeholder="First Name"  >
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                                <label>Last Name</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="first_name" placeholder="Last Name">
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                                <label>Email</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="email" wire:model="email " placeholder="Email Address">
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                                <label>Mobile No</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="number" wire:model="mobile  " placeholder="Mobile Number">
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                                <label>Address line 1</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="address_line_1" placeholder="Address line 1">
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                               <label>Address line 2</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="address_line_1" placeholder="Address line 2">
                            </div>
                            <div class="w-full mt-6 sm:mt-0">
                                <label>City</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="city" placeholder="City">
                            </div><div class="w-full mt-6 sm:mt-0">
                                <label>State</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="text" wire:model="state" placeholder="State Name">
                            </div><div class="w-full mt-6 sm:mt-0">
                                <label>Postcode</label>
                                <input
                                    class="w-full border border-[#E9E4E4] rounded focus:border-primary focus:ring-0 mt-1 block"
                                    type="number" wire:model="postcode" placeholder="Postcode">
                            </div> 
                        </div>
                        <div class="sm:flex gap-6 mt-6">
                            <div class="w-full mt-6 sm:mt-0">
                                <label>Country</label>
                                <select class="nice-select w-full mt-1">
                                    <option selected>Bangladesh</option>
                                    <option>Pakistan</option>
                                    <option>Oman</option>
                                </select>
                            </div>
                            <div class="w-full mt-16 sm:mt-0">
                                <label>Region</label>
                                <select class="nice-select w-full mt-1">
                                    <option selected>Dhaka</option>
                                    <option>Comilla</option>
                                    <option>Chittagong</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:flex gap-6 mt-6">
                            <div class="w-full mt-16 sm:mt-0">
                                <label>City</label>
                                <select class="nice-select w-full mt-1">
                                    <option selected>Dhaka-North</option>
                                    <option>Dhaka-South</option>
                                    <option>Badda</option>
                                </select>
                            </div>
                            <div class="w-full mt-16 sm:mt-0">
                                <label>Area</label>
                                <select class="nice-select w-full mt-1">
                                    <option selected>Keranigonj</option>
                                    <option>Ati Bazar</option>
                                    <option>Atigram</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-8">
                            <button type="submit" class="default_btn rounded small">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>