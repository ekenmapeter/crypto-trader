
       <section>
            <div class="mt-0 md:m-12 m-2">
               <h3 class="mt-6 text-xl m-6">Recent Transactions</h3>
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                      <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                        <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                          <thead class="bg-indigo-300">
                            <tr>
                              <th
                                class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                              >
                                Order ID
                              </th>
                              <th
                                class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                              >
                                Card Type
                              </th>
                              <th
                                class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                              >
                                Status
                              </th>
                              <th
                                class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                              >
                                Payout
                              </th>
                              <th
                                class="px-6 py-3 text-xs tracking-wider text-left text-black font-bold uppercase"
                              >
                                Time
                              </th>
                              <th class="px-6 py-3">
                                Action
                              </th>
                            </tr>
                          </thead>
                           @forelse($transactionsTable as $data)
                          <tbody class="bg-white divide-y divide-gray-200">
                              <tr class="transition-all hover:bg-indigo-300 hover:shadow-lg">
                                <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                      <img
                                        class="w-10 h-10 rounded-full"
                                        src="images/category_logo/{{ $data->logo }}"
                                        alt=""
                                      />
                                    </div>
                                    <div class="ml-4">
                                      <div class="text-sm font-medium text-gray-900">{{ $data->id }}</div>
                                      <div class="text-sm text-gray-500">{{ $data->username }}</div>
                                    </div>
                                  </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  <div class="text-sm text-xs text-gray-900">{{ Str::limit($data->card_type ,25) }}</div>
                                  <div class="md:text-sm text-xs text-gray-500">{{ Str::limit($data->card_country_type , 25) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  @if ($data->status === 1)
                                              <div
                                                  class="text-center bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"
                                              >
                                                  Successful
                                              </div>
                                              @elseif ($data->status === 2)
                                              <div
                                                  class="text-center bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900"
                                              >
                                                  Rejected
                                              </div>
                                              @else
                                              <div
                                                  class="text-center bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900"
                                              >
                                                  Pending
                                              </div>
                                              @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">$ {{ number_format($data->amount) }}</td>
                                <td class="px-6 py-4 text-sm text-black font-bold whitespace-nowrap">
                                  {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                  <button id="dropdownDefault{{ $data->id }}"  data-dropdown-toggle="dropdown{{ $data->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Action <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

                                  <!-- Dropdown menu -->
                                  <div id="dropdown{{ $data->id }}" class="hidden z-10 w-44 bg-indigo-300 rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                      <ul class="py-1 text-sm text-center text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                        <li>
                                          <a href="/preview-order/{{ $data->id }}" target="_blank" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Preview</a>
                                        </li>
                                        <li>
                                          <a href="/approve-order/{{ $data->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</a>
                                        </li>
                                        <li>
                                          <a href="/reject-order/{{ $data->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rejected</a>
                                        </li>
                                      </ul>
                                  </div>
                                </td>
                              </tr>
                            @empty
                          <div>
                              <h3 class="text-red-400 font-extrabold">No Transaction Available</h3>

                          </div>
                          @endforelse
                          </tbody>
                        </table>
                      </div>
                      <div class="p-8">
                        {{ $transactionsTable->links() }}
                    </div>
                    </div>
                    
                  </div>
            </div>
          </section>



