<div class="p-2 px-12 flex-grow  bg-gray-100 mt-2 border-b shadow-lg rounded shadow-blue-500/50 transform  duration-500 ease-in-out">

    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r to-indigo-600 from-blue-400 text-center">Crypto Calculator!</h1>

    <div class="grid grid-cols-5 gap-2 px-12 p-4 justify-center items-center">
          <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/Bitcoin.png" alt="Crypto Calculator" />
          <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/Bitcoin_cash.png" alt="Crypto Calculator" />
          <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/bnb.png" alt="Crypto Calculator" />
          <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/Ethereum.png" alt="Crypto Calculator" />
          <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/Usdt.png" alt="Crypto Calculator" />

    </div>
   
        <div class="mb-6">
            <select
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="crypto"
            >
                <option selected disabled>Select Crypto Coin </option>
                @foreach ($get_crypto as $data)
                <option name="card_categories" value="{{ $data->id }}">{{ $data->coin_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="flex gap-2">
            <div class="mb-6 w-1/2">
                <label for="amount" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Coin Amount</label>
                <input
                    type="text"
                    name="value1"
                    id="value1"
                    min="0"
                    value=""
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter Amount"
                    required
                />
            </div>
            <div class="mb-6 w-1/2">
                <label for="amount" class="block mb-2 text-sm font-medium text-green-600 font-bold dark:text-white">Current Rate</label>
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="rate"
                    id="rate"
                ></select>
            </div>
        </div>

        <div class="mb-6">
            <select class="hidden" name="value2" id="value2" min="0"></select>
            <div class="flex">
                <span class="text-5xl text-blue-500 font-bold rounded-lg p-2">₦</span>
                <input
                    type="text"
                    name="sum"
                    id="sum"
                    class="block h-14 w-full p-4 text-5xl text-white font-extrabold border border-blue-300 rounded-lg bg-blue-500 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    readonly
                />
            </div>
        </div>

        

        <div class="flex md:mt-0 mt-4 items-center justify-center">
          

            <a href="{{ route('login') }}" 
                class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Start Selling
            </a>
        </div>
</div>

@include('user.components.crypto_category') 
