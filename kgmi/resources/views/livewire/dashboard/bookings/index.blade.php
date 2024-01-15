<div>
  @if(isset($pageType) && $pageType == 'edit')
    @include('livewire.dashboard.bookings.create')
  @else  <div class="p-7"> 
    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
      <div class="col-md-4">
        <div class="form-group">
          <label> Start Date :&nbsp; </label>  
          <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="startDate">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label> End Date :&nbsp; </label>  
          <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="endDate">
        </div>
     </div>
      <div class="col-md-4">
        <div class="form-group">
          <label> Plan </label>  
          <select class="w-full rounded border border-stroke bg-gray py-4  font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model="plan">
            <option value="">Select Plans</option>
            @if(!empty($planList))
              @foreach($planList as $key => $planDetail)
                <option value="{{$key}}"> {{$planDetail['plan_name']}} </option>
              @endforeach
            @endif 
          </select>
        </div>
     </div>
      <div class="col-md-4">
        <div class="form-group">
          <label> Search :&nbsp; </label>  
          <input type="search" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Search by booking id" wire:model="s">
        </div>
     </div>
   </div>

    <!-- <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
      <div class="col-md-4">
        <div class="form-group">
          <label><b> Total Amount :&nbsp; ₹ {{number_format($total,2)}} </b></label>  
        </div>
     </div>
    </div> -->
  </div>
      @if (session('success'))
        <div class="w-full">
          <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]" style="color:green;">
            {{ session('success') }}
          </h5> 
        </div> 
      @endif
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gray-2 text-left dark:bg-meta-4">
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              S.No.
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Booking Id
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Plan Name
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Customer Info
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
           Booking Date
            </th>
             <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
           Booking Time
            </th>
           
            <th class="min-w-[290px] py-4 px-4 font-medium text-black dark:text-white">
             Total Amount
            </th>
            <th class="min-w-[100px] py-4 px-4 font-medium text-black dark:text-white text-end">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          @if(count($data))
          @php $i = 1; @endphp
            @foreach($data as $depKey => $bookingDetail)
              <tr>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">{{$i++}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$bookingDetail->booking_id ?? ''}}</p>
                   <a class="flex justify-center rounded bg-primary py-2 px-2 font-medium text-gray hover:bg-opacity-90" href="{{route('home')}}?bookingid={{$bookingDetail->booking_id}}" target="_blank">Payment Link</a>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">@if(isset($planList[$bookingDetail->plan_id]['plan_name'])) {{$planList[$bookingDetail->plan_id]['plan_name']}} @endif</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">
                    Name : {{$bookingDetail->name ?? ''}} 
                    <br> Mob : {{$bookingDetail->mobile_no ?? ''}} <br>
                    Email : {{$bookingDetail->email ?? ''}}
                  </p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">
                    @if(isset($bookingDetail->start_date))
                    From : {{date('d M,Y',strtotime($bookingDetail->start_date))}} <br>
                    @endif
                    @if(isset($bookingDetail->end_date))
                    To : {{date('d M,Y',strtotime($bookingDetail->end_date))}}
                     @endif

                  </p>
                </td>
                   <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">
                    {{$bookingDetail->start_time}} to  {{$bookingDetail->end_time}} 

                  </p>
                </td>
                
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">₹{{number_format($bookingDetail->booking_amount,2)}}</p>

                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <div class="flex items-center space-x-3.5">
                    @can('booking-edit')
                    <button class="hover:text-primary" wire:click="edit({{$bookingDetail->id}})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </button>
                    @endcan
                    @can('booking-delete')
                    <button class="hover:text-primary"  wire:click="$emit('triggerDetail',{{$bookingDetail->id }})"
>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                      </svg>
                    </button>
                    @endcan

                  </div>
                </td>
              </tr>
            @endforeach
          @else
          <tr>
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark" colspan="5">
              Not record found.
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    <div class="mb-5.5">
      {{$data->links()}}
  </div>
  </div>
  @endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (e) {
        @this.on('triggerDetail', id => {
            Swal.fire({
                title: "Are you sure?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.value) {
                    @this.call('deleteBooking',id)
                } 
            });
        });
    });
  </script>

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