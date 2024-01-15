<div>
  @if(isset($pageType) && $pageType == 'detail')
    @include('livewire.dashboard.orders.create')
  @else  <div class="p-7"> 
    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
      <div class="col-md-4">
        <div class="form-group">
          <label> Start Date :&nbsp; </label>  
          <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="startDate">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label> End Date :&nbsp; </label>  
          <input type="date" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" wire:model.live="endDate">
        </div>
     </div>
      <div class="col-md-4">
        <div class="form-group">
          <label> Search :&nbsp; </label>  
          <input type="text" class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" placeholder="Search" wire:model.live="s">
        </div>
     </div>
   </div>
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
              User Detail
            </th>
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Address
            </th>
            {{-- <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Payment Method
            </th> --}}
            @if($type == 'cancel')
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Cancel Remark
            </th>
            @endif
            {{-- <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Payment Status
            </th> --}}
            <th class="min-w-[190px] py-4 px-4 font-medium text-black dark:text-white">
              Order Status
            </th>
            <th class="min-w-[100px] py-4 px-4 font-medium text-black dark:text-white text-end">
             Action
            </th>
          </tr>
        </thead>
        <tbody>
          @if(count($data))
          @php $i = 1; @endphp
            @foreach($data as $depKey => $dataDetail)
              <tr>
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="text-sm">{{$i++}}</p>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  @if(isset($dataDetail->getUserDetail) && !empty($dataDetail->getUserDetail))
                    <p class="text-black dark:text-white">Name : {{$dataDetail->getUserDetail->name ?? ''}}</p>
                    <p class="text-black dark:text-white">Email : {{$dataDetail->getUserDetail->email ?? ''}}</p>
                    <p class="text-black dark:text-white">Phone No. : {{$dataDetail->getUserDetail->mobile_no ?? ''}}</p>
                  @endif
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  @php 
                    $billingAddress = json_decode($dataDetail->billing_address);
                    $shippingAddress = json_decode($dataDetail->shipping_address);
                  @endphp
                  <div>
                    <p class="text-black dark:text-white">Billing Address</p>
                  </div>
                  <div>
                    <p class="text-black dark:text-white">Shipping Address</p>
                  </div>
                </td>
                {{-- <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p class="text-black dark:text-white">@if(isset($dataDetail->payment_method)) {{$dataDetail->payment_method}} @endif</p>
                </td> --}}
                @if($type == 'cancel')
                  <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                    <p class="text-black dark:text-white">@if(isset($dataDetail->cancel_remark)) {{$dataDetail->cancel_remark}} @endif</p>
                  </td>
                @endif
                {{-- <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <p class="inline-flex rounded-full py-1 px-3 text-sm font-medium @if($dataDetail->paid_status == 'Paid') bg-success bg-opacity-10 text-success @else bg-danger bg-opacity-10  text-danger @endif" style="cursor:pointer;">
                    {{$dataDetail->paid_status ?? ''}}
                  </p>
                </td> --}}
                <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark">
                  <select name="" id="" class="inline-flex rounded-full py-1 px-3 text-sm font-medium @if($dataDetail->status == 'Pending') bg-primary bg-opacity-10 text-primary @elseif($dataDetail->status == 'Out For Delivery') bg-info bg-opacity-10  text-info @elseif($dataDetail->status == 'Reached Destination') bg-success bg-opacity-10  text-success @elseif($dataDetail->status == 'Cancel') bg-danger bg-opacity-10  text-danger @endif" onchange="statusChange(this.value , {{$dataDetail->id}})">
                    @if($type == 'pending')
                      <option value="Pending" @if($dataDetail->status == 'Pending') selected @endif> Pending</option>
                    @endif
                    @if($type == 'pending' || $type == 'out-delivery')
                      <option value="Out For Delivery" @if($dataDetail->status == 'Out For Delivery') selected @endif>Out For Delivery</option>
                    @endif
                    @if($type == 'complete' || $type == 'out-delivery')
                      <option value="Reached Destination" @if($dataDetail->status == 'Reached Destination') selected @endif>Complated</option>
                    @endif
                    @if($type != 'complete')
                      <option value="Cancel" @if($dataDetail->status == 'Cancel') selected @endif> Cancel</option>
                    @endif
                  </select>
                </td>
                <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <div class="flex items-center space-x-3.5">
                    @can('view-orders')
                    <button class="hover:text-primary" wire:click="orderDetail({{$dataDetail->id}})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" wire:click="orderDetail({{$dataDetail->id}})" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                      </svg>
                    </button>
                    @endcan
                    @if($type == 'cancel' && $type == 'pending')
                      @can('delete-orders')
                      <button class="hover:text-primary"  wire:click="$dispatch('triggerDetail',{{$dataDetail->id }})"
  >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                      </button>
                      @endcan
                    @endif
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
                    @this.call('deleteOrder',id)
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
        
        window.addEventListener('swal:success', event => {  
            Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.icon, 
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK',
            cancelButtonColor: '#d33',
            cancelButtonText: '',
            
            }).then((result) => {
            if (result.isConfirmed) { 
                   
            }
            }) 
         });
      function statusChange(status,id)
      {
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
              @this.updateStatus(status,id);
            } 
        });
      }
    </script>
</div>