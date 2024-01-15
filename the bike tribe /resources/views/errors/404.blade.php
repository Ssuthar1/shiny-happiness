  <x-front-app-layout> 

    <!-- breadcrumbs -->
    <div class="container">
        <div class="py-5 flex items-center">
            <a href="{{route('homePage')}}" class="flex  items-center">
                <span class="text-primary">
                    <svg width="17" height="17" viewBox="0 0 32 32">
                        <path fill="currentColor"
                            d="m16 2.594l-.719.687l-13 13L3.72 17.72L5 16.437V28h9V18h4v10h9V16.437l1.281 1.282l1.438-1.438l-13-13zm0 2.844l9 9V26h-5V16h-8v10H7V14.437z" />
                    </svg>
                </span>
                <span>
                    <svg width="22" height="22" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10 6L8.59 7.41L13.17 12l-4.58 4.59L10 18l6-6l-6-6z" /></svg>
                </span>

            </a>
            <a href="javascript:void('0')" class="text-secondary text-[13px] sm:text-base">Not found</a>
        </div>
    </div>
    <!-- breadcrumbs end-->

    <!-- 404 page -->
    <div class="container pb-14">
        <div class="max-w-2xl mx-auto">
            <div>  
                <div class="flex mx-auto">
                    <img loading="lazy" src="{{asset('frontend/assets/images/404.svg')}}" class="w-100" alt="page not found">
                </div>
                <div class="flex flex-col mx-auto mt-5">
                    <h4 class="text-center text-xl sm:text-2xl mb-4">You are looking for something that is not available here!</h4>
                    <a href="{{route('homePage')}}" class="default_btn w-44 flex mx-auto rounded">Back to home</a>
                </div>
            </div>
        </div>
    </div> 
   </x-front-app-layout> 

