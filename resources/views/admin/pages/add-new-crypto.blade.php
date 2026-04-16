@extends('layouts.admin')

@section('content')

          <section>


               <div class="mt-0 md:m-12 m-2 lg:px-44 sm:px-0">
                <h3 class="mt-6 text-xl m-6 bg-blue-600 text-white font-bold rounded px-2 py-1">All Crypto Coin</h3>
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
                          Coin Name
                        </th>
                        <th scope="col" class="text-xs tracking-wider text-center text-black font-bold uppercase">
                          Rate
                        </th>
                        <th scope="col" class="text-xs tracking-wider text-center text-black font-bold uppercase">
                          Action
                        </th>
                      </tr>
                    </thead>
                     @forelse($getcoin as $data)

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="transition-all hover:bg-indigo-300 hover:shadow-lg">
                          <td class="md:px-6 px-2 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 w-10 h-10">
                                <img
                                  class="w-10 h-10 rounded-full"
                                  src="/images/crypto_logo/{{ $data->logo }}"
                                  alt=""
                                />
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $data->coin_name }}</div>
                              </div>
                            </div>
                          </td>
                          <td class="md:px-6 px-2 py-2 md:py-4 whitespace-nowrap">
                            <div class="text-sm text-xs text-gray-900">
                              <div class="text-sm text-center font-medium text-gray-900">{{ $data->coin_rate }}</div>
                            </div>
                          </td>
                          <td class="md:px-6 px-2 py-2 md:py-4 whitespace-nowrap">
                            <div class="text-sm text-xs text-gray-900">
                              <!-- Main modal -->
            <div id="basicModal" x-data="{ open: false }" @open-me="open=false" @close-me="open=true">
                <button class="bg-blue-700 p-2 text-sm rounded text-white float-right md:mr-8 mr-2"
                        @click.prevent="open = true"
                        aria-controls="basic-modal"
                >Edit</button>
                <div @keydown.window.escape="open = false" x-show="open" class="relative z-10" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">

                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background backdrop, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>


                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

                            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full" @click.away="open = false">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <form class="space-y-6" method="POST" action="{{ route('edit-crypto') }}" enctype="multipart/form-data">
                                 @csrf
                                <div class="grid grid-cols-2">
                                  <img
                                  class="w-10 h-10 rounded-full"
                                  src="/images/crypto_logo/{{ $data->logo }}"
                                  alt=""
                                />

                                    <label for="coin_name" class="block mb-2 text-sm float-left font-medium text-gray-900 dark:text-white">Edit {{ $data->coin_name }}</label>
                                </div>
                                <div class="flex justify-center">
                                  <img class="rounded"
                                  src="/qr_codes/{{ $data->qr_code }}"
                                  alt="{{ $data->coin_name }}"
                                />
                                </div>
                                <div>
                                  <label for="coin_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Coin Name <span class="bg-indigo-500 px-1 text-white font-bold"> {{ $data->coin_name }}</span></label>
                                    <input type="text" name="coin_name" id="coin_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" name="coin_name" value="{{ $data->coin_name }}" placeholder="{{ $data->coin_name }}" required readonly>
                                </div>
                                <div>
                                  <label for="wallet_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wallet Address </label>
                                    <input type="text" name="wallet_address" id="wallet_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $data->wallet_address }}" placeholder="{{ $data->wallet_address }}" required>
                                </div>
                                <div>
                                    <label for="coin_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Rate</label>
                                    <input type="number" name="coin_rate" id="coin_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $data->coin_rate }}" placeholder="" required>
                                </div>
                                <input type="hidden" name="id" value="{{ $data->id }}">


                              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="qr_code">Upload QR Code</label>
                              <input type="file" id="qrcode_upload" class="filepond" name="qrcode_upload" multiple data-allow-reorder="true" data-max-file-size="5MB" data-max-files="1"  />


                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-50 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false">
                                        Update {{ $data->coin_name }}
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
                          </td>

                        </tr>
                      @empty
                    <div>
                        <h3 class="text-red-400 font-extrabold">No Crypto Available</h3>

                    </div>
                    @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="p-8">
              </div>
              </div>

              </div>
            </div>
        </section>
    </div>
@include('admin.components.qrcode_upload')

@endsection



