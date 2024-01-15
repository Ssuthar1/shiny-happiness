<div class="col-auto">
        @if($location=='inner')
        <div class="single-field -w-410 d-flex x-gap-10 y-gap-20">
              <div>
                <input class="bg-white h-60" type="email" wire:model.defer="email"  placeholder="Your Email">
                 @error('email') <div class="error-message">{{ $message }}</div>@enderror
              </div>

              <div>
                <button class="button -md h-60 bg-blue-1 text-white" wire:click.prevent="store()" wire:loading.remove >Subscribe</button>
                <button class="button -md h-60 bg-blue-1 text-white" wire:click.prevent="store()" wire:loading >Loading...</button>
              </div>
            </div>
        @endif

        @if($location=='home')
            <i class="icon-newsletter text-60 sm:text-40 text-white"></i>

            <h2 class="text-30 sm:text-24 lh-15 text-white mt-20">Your Travel Journey Starts Here</h2>
            <p class="text-white mt-5">Sign up and we'll send the best deals to you</p>

            <div class="single-field -w-410 d-flex x-gap-10 flex-wrap y-gap-20 pt-30">
              <div class="col-auto">
                <input class="col-12 bg-white h-60" type="email" wire:model.defer="email" placeholder="Your Email">
                 @error('email') <div class=" px-1 text-[#fd3d57]">{{ $message }}</div>@enderror
              </div>
              <div class="col-auto">
                <button class="button -md -white h-60 bg-dark-1 text-white" type="button" wire:click.prevent="store()" wire:loading.remove  >Subscribe</button>
                <button class="button -md -white h-60 bg-dark-1 text-white" type="button" wire:click.prevent="store()" wire:loading  >Wait ...</button>
              </div>
            </div>
            @endif
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