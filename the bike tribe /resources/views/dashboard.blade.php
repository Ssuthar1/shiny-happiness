<x-app-layout>

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Card Item Start -->
            <div
              class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
</svg>

              </div>
        
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h4 class="text-title-md font-bold text-black dark:text-white">
                 {{number_format($totalUsers) ?? 0}}
                  </h4>
                  <span class="text-sm font-medium">Total Users</span>
                </div>
        
                <!-- <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                  0.43%
                  <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                      fill="" />
                  </svg>
                </span> -->
              </div>
            </div>
            <!-- Card Item End -->
        
            <!-- Card Item Start -->
            <div
              class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
</svg> 
              </div>
        
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h4 class="text-title-md font-bold text-black dark:text-white">
                      {{number_format($totalDestinations) ?? 0}}
                  </h4>
                  <span class="text-sm font-medium">Total Destinations</span>
                </div>
        
              <!--   <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                 11112
                  <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                      fill="" />
                  </svg>
                </span> -->
              </div>
            </div>
            <!-- Card Item End -->
        
            <!-- Card Item Start -->
            <div
              class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
</svg>

              </div>
        
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h4 class="text-title-md font-bold text-black dark:text-white">
                   {{$totalTours}}
                  </h4>
                  <span class="text-sm font-medium">Total Tours</span>
                </div>
        
               <!--  <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                  2.59
                  <svg class="fill-meta-3" width="10" height="11" viewBox="0 0 10 11" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M4.35716 2.47737L0.908974 5.82987L5.0443e-07 4.94612L5 0.0848689L10 4.94612L9.09103 5.82987L5.64284 2.47737L5.64284 10.0849L4.35716 10.0849L4.35716 2.47737Z"
                      fill="" />
                  </svg> -->
                </span>
              </div>
            </div>
            <!-- Card Item End -->
        
            <!-- Card Item Start -->
            <div
              class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
</svg>

              </div>
        
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h4 class="text-title-md font-bold text-black dark:text-white">
                   {{$totalBooking}}
                  </h4>
                  <span class="text-sm font-medium">Total Booking</span>
                </div>
        <!-- 
                <span class="flex items-center gap-1 text-sm font-medium text-meta-5">
                  0.95%
                  <svg class="fill-meta-5" width="10" height="11" viewBox="0 0 10 11" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M5.64284 7.69237L9.09102 4.33987L10 5.22362L5 10.0849L-8.98488e-07 5.22362L0.908973 4.33987L4.35716 7.69237L4.35716 0.0848701L5.64284 0.0848704L5.64284 7.69237Z"
                      fill="" />
                  </svg>
                </span> -->
              </div>
            </div>
            <!-- Card Item End -->
          </div>
        
          

</x-app-layout>
