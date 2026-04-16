@include('admin.components.header') 
    @include('admin.components.image-preview')

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
      <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light  mb-6">
        
        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
          <div
            x-show="isSidebarOpen"
            @click="isSidebarOpen = false"
            class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
          <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

          <!-- Mobile bottom bar -->
          @include('admin.components.mobile-sidebar') 

          <!-- Left mini bar -->
          @include('admin.components.desktop-sidebar') 

          @include('admin.components.sidebar-pages') 
        </div>
        <div class="flex flex-col flex-1">
          
          @include('admin.components.navbar-header') 

          <div class="w-5/6 md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto">
            <div class="mt-16 mb-16 bg-white border-b shadow-lg roundedshadow-blue-500/50 ">
                <div class="w-full">

                    <h3 class="font-medium bg-indigo-300 font-bold text-black text-left px-6 p-6"><a href="{{ url()->previous() }}" class="bg-red-600 p-2 font-bold text-white pl-6 pr-3 rounded-lg">Back</a> Order ID #{{ $previewTransaction->id }}</h3>
                      <div class="mt-5 w-full text-sm">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Order No </p>
                                    {{ $previewTransaction->id }}
                            </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card Type </p>
                                    {{ $previewTransaction->card_type }}
                            </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card Country Type </p>
                                    {{ $previewTransaction->card_country_type }}
                            </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card Amount </p>
                                   $ {{ $previewTransaction->card_amount }}
                             </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Rate</p>
                                   ₦  {{ $previewTransaction->rate }}
                            </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Transaction Type</p>
                                    {{ $previewTransaction->transaction_type }}
                            </div>

                            <div class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                              <p class="font-bold text-black">Payout</p>
                                    ₦ {{ $previewTransaction->amount }}
                                
                             </div>


                              @if ($previewTransaction->status === 1)
                                        <div class="w-full border-t bg-green-300 border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                          <p class="font-bold text-black">Status</p>
                                              <span  id="myInput">Approved</span>
                                       </div>
                              @elseif ($previewTransaction->status === 2)
                                        <div class="w-full border-t bg-red-300 border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                          <p class="font-bold text-black">Status</p>
                                              <span  id="myInput">Rejected</span>
                                       </div>
                              @else
                                        <div class="w-full border-t bg-yellow-300 border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                          <p class="font-bold text-black">Status</p>
                                              <span class="font-bold text-white" id="myInput">Pending</span>
                                       </div>
                              @endif

                           <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card 1</p>
                                <img src="{{ asset($previewTransaction->card1) }}" alt="Card 1" onclick="showModal('{{ asset($previewTransaction->card1) }}')" />
                            
                                <a href="{{ asset($previewTransaction->card1) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a> 
                            </div>


                             
                             @if ($previewTransaction->card2 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 2</p>
                                        <img src="{{ asset($previewTransaction->card2) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card2) }}')" />
                                        <a href="{{ asset($previewTransaction->card2) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                              
                              @if ($previewTransaction->card3 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 2</p>
                                        <img src="{{ asset($previewTransaction->card3) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card3) }}')" />
                                        <a href="{{ asset($previewTransaction->card3) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card4 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 4</p>
                                        <img src="{{ asset($previewTransaction->card4) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card4) }}')" />
                                        <a href="{{ asset($previewTransaction->card4) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card5 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 5</p>
                                        <img src="{{ asset($previewTransaction->card5) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card5) }}')" />
                                        <a href="{{ asset($previewTransaction->card5) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card6 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 6</p>
                                        <img src="{{ asset($previewTransaction->card6) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card6) }}')" />
                                        <a href="{{ asset($previewTransaction->card6) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card7 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 7</p>
                                        <img src="{{ asset($previewTransaction->card7) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card7) }}')" />
                                        <a href="{{ asset($previewTransaction->card7) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card8 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 2</p>
                                        <img src="{{ asset($previewTransaction->card8) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card8) }}')" />
                                        <a href="{{ asset($previewTransaction->card8) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card9 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 9</p>
                                        <img src="{{ asset($previewTransaction->card9) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card9) }}')" />
                                        <a href="{{ asset($previewTransaction->card9) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                                @if ($previewTransaction->card10 === null)
                                @else
                                    <div class="img-container shadow-lg shadow-blue-500 w-full h-full object-cover cursor-pointer border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                        <p class="font-bold text-black">Card 10</p>
                                        <img src="{{ asset($previewTransaction->card10) }}" alt="" onclick="showModal('{{ asset($previewTransaction->card10) }}')" />
                                        <a href="{{ asset($previewTransaction->card10) }}" class="flex justify-center font-bold rounded-lg text-white bg-blue-600 p-2 items-center mt-2" download>Download</a>
                                    </div>
                                @endif
                                
                               
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
 
    </div>


 @include('admin.components.auth-footer') 



