@include('admin.components.header') 


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
        <div class="grid grid-cols-1 md:flex md:flex-col md:flex-1">
          
          @include('admin.components.navbar-header') 



        <section>
            <div class="md:flex grid-cols-1 md: w-1/2 lg:1/2 w-1/2 items-center md:h-12 md:p-8 m-6 p-4 bg-violet-400 shadow rounded-lg">
                <div class="hidden md:inline-flex flex-shrink-0 items-center justify-center h-8 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                  <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" fill="blue"></path> </svg>
                </div>
                <div>
                  <span class="inline-block text-1xl text-white font-bold">Total</span><br>
                  <span class="inline-block text-xl text-white font-bold">{{ $totalNotofication }}</span>
                </div>
              </div>
               <div class="mt-0 md:m-12 m-2">
                <div class="flex m-2 gap-10">
                  <div><h3 class="text-xl m-2">All Nottification</h3></div>
                  <div class="float-right justify-center"><a href="{{ route('create-notification') }}" class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</a></div>
                </div>
             
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                  <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-indigo-300">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                        >
                          Subject
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                        >
                          Message
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                        >
                          Time
                        </th>
                      </tr>
                    </thead>
                     @forelse($notificationTable as $data)
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="transition-all hover:bg-indigo-300 hover:shadow-lg">
                          <td class="md:px-6 px-2 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900"><a href="/preview-notification/{{ $data->id }}">{{ $data->subject }}</a></div>
                              </div>
                            </div>
                          </td>
                          <td class="md:px-6 px-2 py-2 md:py-4 whitespace-nowrap">
                            <div class="text-sm text-xs text-gray-900"><a href="/preview-notification/{{ $data->id }}">{{ Str::limit($data->message ,25) }}</a></div>
                          </td>
                          
                          <td class="md:px-6 px-2 py-2 md:py-4 text-sm text-black font-bold whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                          </td>

                          
                        </tr>
                      @empty
                    <div>
                        <h3 class="text-red-400 font-extrabold">No Notification Available</h3>

                    </div>
                    @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="p-8">
                  {{ $notificationTable->links() }}
              </div>
              </div>
              
              </div>
            </div>
        </section> 
    </div>

 @include('admin.components.auth-footer') 



