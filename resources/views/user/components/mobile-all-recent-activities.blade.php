<div class="md:hidden lg:hidden xl:hidden 2xl:hidden block sm:rounded-lg p-4 shadow-lg shadow-blue-500/50">
    <div class="flex items-center border-b shadow-md shadow-blue-500/50 justify-between bg-white px-6 py-5 font-semibold border-b border-gray-100">
                    <span>Recent Activities</span>
                </div>
<div class="w-full max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-4">
    
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($activities as $data)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="/images/yuwantrade_logo.png" alt="yuwangtrade logo">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-md font-extrabold text-black truncate dark:text-white">
                            {{ Str::limit($data->subject ,20) }}
                        </p>
                        <p class="text-xs font-medium text-gray-600 truncate dark:text-white">
                            {{ Str::limit($data->message , 30) }}
                        </p>
                        <p class="badge text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-y') }} <span class="font-semibold text-black">{{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}</span>
                        </p>
                    </div>
                </div> 
            </li>   
             @empty
             <div>
                <h3 class="text-red-400 font-extrabold">No Activities Available</h3>
            </div>
           @endforelse      
        </ul>
   </div>
</div>

    {{ $activities->links() }}
</div>