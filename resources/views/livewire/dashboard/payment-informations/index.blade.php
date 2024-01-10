<div>
  <div class="p-7"> 
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
          <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Search by booking id" wire:model="s">
        </div>
     </div>
   </div>

    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
      <div class="col-md-4">
        <div class="form-group">
          <label><b> Total Amount :&nbsp; ₹ {{number_format($total,2)}} </b></label>  
        </div>
     </div>
    </div>
  </div>
  @if (session('success'))
    <div class="w-full"   x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" style="color:green;">
      <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
        {{ session('success') }}
      </h5> 
    </div> 
  @endif
  @if (session('error'))
    <div class="w-full"   x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" style="color:red;">
      <h5 class="mb-3 text-lg font-bold text-black dark:text-[#a70725]">
        {{ session('error') }}
      </h5> 
    </div> 
  @endif
  <div class="max-w-full overflow-x-auto">

      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gray-2 text-left dark:bg-meta-4">
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              S.No.
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
             Plan Name
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
             Booking Id
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
             Transaction Id
            </th>
             <th class="min-w-[200px] py-4 px-4 font-medium text-black dark:text-white">
              Amount
            </th>
             <th class="min-w-[200px] py-4 px-4 font-medium text-black dark:text-white">
             Status
            </th>
            <th class="min-w-[100px] py-4 px-4 font-medium text-black dark:text-white text-end">
              Transaction Date
            </th>
          </tr>
        </thead>
        <tbody>
          @if(count($data))
          @php $i = 1; @endphp
            @foreach($data as $depKey => $recordDetail)
              <tr>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">{{$i++}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">
                    @if(isset($planList[$recordDetail->getBookingDetail->plan_id]['plan_name'])) {{$planList[$recordDetail->getBookingDetail->plan_id]['plan_name']}} @endif</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$recordDetail->getBookingDetail->booking_id ?? ''}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$recordDetail->transaction_id ?? ''}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">₹ {{number_format($recordDetail->amount,2) ?? '0.00'}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$recordDetail->status}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">{{$recordDetail->transaction_date  ?? ''}}</p>
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
</div>