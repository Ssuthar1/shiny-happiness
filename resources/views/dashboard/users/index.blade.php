<x-app-layout> 
          <!-- Breadcrumb Start -->
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <h2 class="font-semibold text-title-md2 text-black dark:text-white">{{ucfirst($type)}}</h2>

            <nav>
              <ol class="flex items-center gap-2">
                <li><a href="{{route('dashboard')}}">Dashboard /</a></li>
                <li class="text-primary">{{ucfirst($type)}}</li>
              </ol>
            </nav>
          </div>
          <!-- Breadcrumb End -->

          <!-- ====== Table Section Start -->
          <div class="flex flex-col gap-10">
             
           	<div  class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">

			    <livewire:dashboard.users-listing :type="$type"    />  
			</div>
            
          </div>
          <!-- ====== Table Section End -->
      

</x-app-layout>
