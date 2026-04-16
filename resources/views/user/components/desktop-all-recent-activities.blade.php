
<div class="md:ml-24 md:mr-24 hidden md:block relative sm:rounded-lg p-4 shadow-lg shadow-blue-500/50">
   <div class="flex items-center border-b shadow-md shadow-blue-500/50 justify-between bg-white px-6 py-5 font-semibold border-b border-gray-100">
                    <span>Recent Activities</span>
                </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
        
       
        <tbody>
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Subject
                </th>
                <th scope="col" class="py-3 px-6">
                    Message
                </th>
                <th scope="col" class="py-3 px-6">
                    Date
                </th>
            </tr>
        </thead>
             @forelse($activities as $data)
            <tr class="bg-white border-b shadow-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mb-2">
                
                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="pl-3">
                        <div class="text-xs font-bold">{{ Str::limit($data->subject ,25) }}</div>
  
                    </div>  
                </th>
                <td class="py-4 px-6">
                    <div class="text-xs font-semibold">{{ Str::limit($data->message , 90) }}</div>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <div class="text-xs font-semibold">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
                    </div>
                </td>
            </tr>

            
                @empty
                    <div>
                        <h3 class="text-red-400 font-extrabold">No Activities Available</h3>

                    </div>
           @endforelse
        </tbody>
    </table>
    {{ $activities->links() }}
</div>

