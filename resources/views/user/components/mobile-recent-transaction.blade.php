<div class="md:hidden block sm:rounded-lg p-4 shadow-lg shadow-blue-500/50">
    
<div class="w-full max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($transactionsTable as $data)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="images/category_logo/{{ $data->logo }}" alt="google-play">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{ Str::limit($data->card_type ,15) }}
                        </p>
                        <p class="badge text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-y') }} <span class="font-semibold text-black">{{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}</span>
                        </p>
                    </div>
                    @if ($data->status === 1)
                    <div class="inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
                        $ {{ number_format($data->amount) }}
                    </div>
                    @elseif ($data->status === 2)
                    <div class="inline-flex items-center bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
                        $ {{ number_format($data->amount) }}
                    </div>
                    @else
                    <div class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">
                        $ {{ number_format($data->amount) }}
                    </div>
                    @endif


                </div> 
            </li>   
             @empty
             <div>
                <h3 class="text-red-400 font-extrabold">No Transaction Available</h3>
            </div>
           @endforelse      
        </ul>
   </div>
</div>

    <a  href="{{ route('user-transactions') }}" class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 float-right mt-10  mb-20">All Transaction</a>
</div>




