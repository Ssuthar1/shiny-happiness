 <div class="md:w-5/12 py-6 px-4 sm:px-12 md:px-0 md:py-0 md:pt-[90px] md:pb-[105px]">
                    <div>
                        <h2 class="text-2xl sm:text-[26px] md:text-[28px] mb-4 text-secondary">Download Fresh Fruit Express App
                            Now!</h2>
                        <p class="mb-6 text-secondary">Shopping fastly and easily more with our app. Get a link to
                            download
                            the app on your
                            phone</p>

                        <div class="flex">
                            <input type="email" wire:model="email" placeholder="Email Address"
                                class="w-full bg-white rounded-l-[5px] border border-primary border-r-transparent focus:ring-0 focus:border-primary text-sm px-5 py-[14px] focus:outline-none">
                            <button type="button" wire:loading.remove wire:click.prevent="store()" class="min-w-[120px] primary-btn rounded-l-none">Subscribe</button>
                             <button type="button" wire:loading 
                                       class="min-w-[120px] primary-btn rounded-l-none">Wait ...</button>  
                           
                        </div>
                        <div class="flex">
                             @error('email') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                            </div>


                        <div class="flex items-center mt-[35px]">
                            <a href="https://play.google.com/store/apps" target="_blank" class="mr-4">
                                <img src="{{asset('frontend/assets/images/download-1.png')}}" class="w-[120px] rounded-[5px] flex-shrink-0"
                                     alt="DownloadApp from  Google Play Store" title="DownloadApp from  Google Play Store">
                            </a>
                            <a href="https://www.apple.com/in/app-store/" target="_blank">
                                <img src="{{asset('frontend/assets/images/download-2.png')}}" class="w-[120px] rounded-[5px] flex-shrink-0"
                                    alt="DownloadApp from  App Store" title="DownloadApp from  App Store">
                            </a>
                        </div>
                    </div>
                    
</div> 