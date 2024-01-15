<div class="max-w-full overflow-x-auto">

  @if($mode=="update-permission")
      <h3 class="font-semibold text-black dark:text-white mb-5.5">Manage Permission ({{$selectedRoleInfo->name}})</h3>
      <div class="right mb-5.5">
      <button wire:click="back()" class="flex  justify-center rounded bg-primary p-3 font-medium text-gray"> <- Back</button>
      </div>
      <table class="w-full table-auto mb-5.5"> 
      <tbody>
        <tr>
          @foreach($allPermissions as $key=> $permissionInfo)

          <td class="mb-5">  <label>
                  <input type="checkbox"    wire:model.live="selectedPermissions" value="{{$permissionInfo->id}}"

                    > {{$permissionInfo->name}} 
                </label>  
          </td>
          @if($key%4==0 && $key>0)
        </tr>
        <tr>
          @endif
          @endforeach 
        </tr>
      </tbody>
    </table>
       <div class="right mb-5.5">
      <button wire:click="updatePermission()" class="flex  justify-center rounded bg-primary p-3 font-medium text-gray">Update Permission for Selected Role</button>
      </div>
  @else
    <table class="w-full table-auto mb-5.5">
      <thead>
        <tr class="bg-gray-2 text-left dark:bg-meta-4">
          <th class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
          Role
          </th>
          <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
          Total Users
          </th>  
          @can('roles-edit')
          <th class="py-4 px-4 font-medium text-black dark:text-white">
            Actions (Manage Permissions)
          </th>
          @endcan
        </tr>
      </thead>
      <tbody>
      	@foreach($roles as $roleInfo)
        <tr>
          <td class="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
          	   <p class="text-black dark:text-white">{{$roleInfo->name}}</p>
          </td>
         
            <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
            <p class="text-black dark:text-white">{{$roleInfo->users_count}}</p>
          </td> 
           @can('roles-edit')
          <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
            <div class="flex items-center space-x-3.5">
              <button class="hover:text-primary" wire:click="editPermission({{$roleInfo->id}})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg> 
              </button>
              
           
            </div>
          </td>
          @endcan
        </tr>
        @endforeach
        
      </tbody>
    </table>

    @endif
    
  </div>