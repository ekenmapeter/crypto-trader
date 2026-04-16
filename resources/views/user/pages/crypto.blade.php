@include('user.components.header') 


<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
      <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light  mb-6">
        
        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
          <div
            x-show="isSidebarOpen"
            @click="isSidebarOpen = false"
            class="fixed inset-0 z-10 bg-[#F5A623] text-black font-bold bg-opacity-50 lg:hidden"></div>
          <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

          <!-- Mobile bottom bar -->
          @include('user.components.mobile-sidebar') 

          <!-- Left mini bar -->
          @include('user.components.desktop-sidebar') 

          @include('user.components.sidebar-pages') 
        </div>
        <div class="flex flex-col flex-1">
          
          @include('user.components.navbar-header') 

         
        <div class="m-12 md:pl-28 md:pr-28 ">
          <h1 class="mb-2 text-2xl sm:mb-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-black">TRADE <mark class="px-2 mt-2 text-black bg-[#F5A623] text-black font-bold rounded dark:bg-[#F5A623] text-black font-bold">Crypto To Naira</mark> </h1>
          <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Crypto services at the best rate Today!!</p>
        </div>

        <section class="md:pt-0 pt-0 justify-center px-2 mb-6">
          <div class="md:pl-28 md:pr-28 pt-0">
          <h3 data-aos="fade-up" data-aos-anchor-placement="center-bottom" class="p-4 text-3xl font-extrabold text-gray-900 dark:text-black">
              <span class="text-transparent bg-clip-text bg-gradient-to-r to-indigo-600 from-blue-400 text-center"> Current Crypto Coin we accept?</span>
          </h3>
        @include('guest.components.live-crypto-update')

            </div>
        </section>

        <section class="lg:px-56 lg:py-12 lg:py-0 py-24 lg:mb-20">
          <div class="w-full lg:px-14 px-2 mb-20 justify-center text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-black">
            @foreach($getcoin as $data)
            <div  class="grid grid-cols-3 gap-4 gap-12 items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg hover:bg-gray-100 hover:text-blue-700">
              <div>
                <img class="w-10 h-10 rounded-full float-left" src="/images/crypto_logo/{{ $data->logo }}" alt="{{ $data->coin_name }}" />
              </div>
                <div>
                  {{ $data->coin_name }}
                </div>
                <div>
                  <!-- Main modal -->
            <div id="basicModal" x-data="{ open: false }" @open-me="open=false" @close-me="open=true">
                <button class="bg-blue-700 p-2 text-sm rounded text-black float-right md:mr-8 mr-2"
                        @click.prevent="open = true"
                        aria-controls="basic-modal"
                >Sell Now</button>
                <div @keydown.window.escape="open = false" x-show="open" class="relative z-10" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">

                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background backdrop, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>


                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

                            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full" @click.away="open = false">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <form class="space-y-6" method="POST" action="{{ url('trade-crypto-content') }}" enctype="multipart/form-data">
                                 @csrf
                                <div class="grid grid-cols-2">
                                  <img
                                  class="w-10 h-10 rounded-full"
                                  src="/images/crypto_logo/{{ $data->logo }}" '
                                  '
                                  alt=""
                                />

                                    <label for="coin_name" class="block mb-2 text-sm float-left font-medium text-gray-900 dark:text-black">Edit {{ $data->coin_name }}</label>
                                </div>
                                <div class="flex justify-center">
                                  <img class="rounded" class="w-24 h-24" 
                                  src="/qr_codes/{{ $data->qr_code }}"
                                  alt="{{ $data->coin_name }}"
                                />
                                </div>
                                <div>
                                  <span class="bg-indigo-500 px-2 py-1 rounded text-black font-bold"> {{ $data->coin_name }}</span> <a href="{{ route('calculator') }}">Click here to see the convertion rate</a>
                                </div>
                                <div>
                                  <label for="wallet_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Transfer Wallet Address </label>
                                  <span class="wallet-address bg-indigo-500 px-2 py-2 rounded text-black font-extrabold">{{ $data->wallet_address }}</span>
                                  <button class="copy-btn float-right rounded bg-indigo-700 text-black font-bold p-2 -mt-4" data-text="{{ $data->wallet_address }}">Copy</button>
                              </div>
                                <div>
                                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Amount</label>
                                    <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black" value="" placeholder="$10" required>
                                </div>
                                <input type="hidden" name="coin_id" value="{{ $data->id }}">
                                <input type="hidden" name="coin_rate" value="{{ $data->coin_rate }}">
                                <input type="hidden" name="wallet_address" value="{{ $data->wallet_address }}">
                                <input type="hidden" name="coin_name" value="{{ $data->coin_name }}">
                                <input type="hidden" name="logo" value="{{ $data->logo }}">

                                
                              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black" for="receipt_upload">Upload Receipt / Screenshot</label>
                              <input type="file" id="receipt_upload" class="filepond" name="receipt_upload" multiple data-allow-reorder="true" data-max-file-size="5MB" data-max-files="1"  />
 

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-[#F5A623] text-black font-bold text-base font-medium text-black hover:bg-blue-50 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false">
                                        Confirm Transaction
                                    </button>
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false">
                                        Cancel
                                    </button>
                                </div>
                               
                            </form>
                        </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- End Main modal -->
                </div>

            </div>
            @endforeach
        </div>
        </section>
        


      </div>


    </div>
@include('user.scripts.upload_reciept')
@include('user.scripts.copy_n_paste_wallet') 
 @include('user.components.auth-footer') 


 
