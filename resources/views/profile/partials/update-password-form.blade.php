<section>
    <div  class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                  <div class="border-b border-stroke py-4 px-7 dark:border-strokedark">
                    <h3 class="font-medium text-black dark:text-white">
                     {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </h3>
                  </div>
   
        <div class="p-7">
            @if (session('status') === 'password-updated') 
                <div class="w-full"   x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 5000)">
                      <h5 class="mb-3 text-lg font-bold text-black dark:text-[#34D399]">
                       {{ __('Password updated successfully.') }}
                      </h5> 
                </div> 
            @endif 
            <form method="post" action="{{ route('password.update') }}"  >
                @csrf
                @method('put')

                   <div class="mb-5.5">
                    <x-input-label for="current_password" :value="__('Current Password')" />
                    <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

              <div class="mb-5.5">
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

               <div class="mb-5.5">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                    <div class="flex justify-start gap-4.5">
                       
                        <button
                          class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90"
                          type="submit">
                          Save
                        </button>
                         <button
                          class="flex justify-center rounded border border-stroke py-2 px-6 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
                          type="submit">
                          Cancel
                        </button>
                      </div>
            </form>
        </div>
    </div>
</section>
