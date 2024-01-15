
 <div class="w-full md:pl-3 lg:pl-0">
                            <div>
                                <h4 class="text-lg text-secondary mt-6 mb-[15px]">NEWSLETTER</h4>
                                <form class="flex">
                                    <input type="email" wire:model="email" placeholder="Your email address"
                                        class="py-2.5 px-[15px] text-[13px] w-full sm:w-[230px] md:w-full lg:w-[230px] text-secondary bg-transparent rounded-l-[5px] border border-[#c7c7c7] focus:ring-0 focus:border-primary">

                                    <button wire:loading.remove type="button" wire:click.prevent="store()"
                                        class="py-2 px-2.5 min-w-[105px] rounded-r-[5px] rounded-l-none primary-btn">SUBSCRIBE</button>
                                    <button type="button" wire:loading 
                                        class="py-2 px-2.5 min-w-[105px] rounded-r-[5px] rounded-l-none primary-btn">Wait ...</button>  

                                </form>
                                @error('email') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
                            </div>
    <script>
     window.addEventListener('swal:Subscribersuccess', event => { 
        Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon, 
        })
    });
   </script>                         
</div>
 

 