<x-app-layout>
     
          <div class="mx-auto">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              <h2 class="text-title-md2 font-bold text-black dark:text-white">
              {{$module}}
              </h2>

              <nav>
                <ol class="flex items-center gap-2">
                  <li><a class="font-medium" href="{{route('dashboard')}}">Dashboard /</a></li>
                  <li class="font-medium text-primary">{{$module}}</li>
                </ol>
              </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Settings Section Start -->
            <div class="grid grid-cols-5 gap-8">
              <div class="col-span-5 xl:col-span-5">
                @if($action=='password')
                  @include('profile.partials.update-password-form')
                @else
                  @include('profile.partials.update-profile-information-form') 
                @endif
                 
           
              
            </div>
            <!-- ====== Settings Section End -->
          </div>
       

 
</x-app-layout>
