
<div class="hidden md:block relative sm:rounded-lg p-4 shadow-lg shadow-blue-500/50">
   
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        
       
        <tbody>
             <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Transaction Type
                </th>
                <th scope="col" class="py-3 px-6">
                    Date
                </th>
                <th scope="col" class="py-3 px-6">
                    Amt / Rate
                </th>
                <th scope="col" class="py-3 px-6">
                    Payout
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
            </tr>
        </thead>
             @forelse($transactionsTable as $data)
            <tr class="bg-white border-b shadow-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mb-2">
                
                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="images/category_logo/{{ $data->logo }}" alt="Jese image">
                    <div class="pl-3">
                        <div class="text-xs font-semibold">{{ Str::limit($data->card_type ,25) }}</div>
                        <div class="text-xs font-normal text-gray-500">{{ Str::limit($data->card_country_type , 25) }}</div>
                    </div>  
                </th>
                <td class="py-4 px-6">
                    <div class="text-xs font-semibold">{{ \Carbon\Carbon::parse($data->created_at)->format('jS F Y') }}</div>
                    <div class="font-normal text-gray-900">{{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}</div>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center text-center justify-center">
                        <span class="font-semibold text-black pr-2">{{ $data->card_amount }}</span>  |  <span class="text-blue-600 font-black pl-2"> {{ $data->rate }}</span>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <a href="#" class="inline-block font-medium text-blue-600 dark:text-blue-500 hover:underline">$ {{ number_format($data->amount) }}</a>
                </td>
                <td class="py-4 px-6">
                    @if ($data->status === 1)
                                        <div
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                                        >
                                            Successful
                                        </div>
                                        @elseif ($data->status === 2)
                                        <div
                                            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                        >
                                            Rejected
                                        </div>
                                        @else
                                        <div
                                            class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900"
                                        >
                                            Pending
                                        </div>
                                        @endif
                </td>
            </tr>

            
                @empty
                    <div>
                        <h3 class="text-red-400 font-extrabold">No Transaction Available</h3>

                    </div>
           @endforelse
        </tbody>
    </table>
    <a  href="{{ route('user-transactions') }}" class="text-white bg-indigo-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 float-right mt-10">All Transaction</a>
</div>

