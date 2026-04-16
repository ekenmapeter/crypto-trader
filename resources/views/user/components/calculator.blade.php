<div class="p-2 flex-grow bg-white mt-2 border-b shadow-lg rounded shadow-blue-500/50 transform hover:scale-105 duration-500 ease-in-out">
    <form method="POST" action="{{ url('trade_single_card') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="mb-6">
            <select
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="categories" 
            >
                <option selected disabled>Select Card Category </option>
                @foreach ($categories as $data)
                <option name="card_categories" value="{{ $data->id }}">{{ $data->card_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="sub_categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Card Sub Category</label>
            <select
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="card_sub_categories"
                id="sub_categories"
            ></select>
        </div>
        <div class="flex gap-2">
            <div class="mb-6 w-1/2">
                <label for="amount" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Trade Amount</label>
                <input
                    type="text"
                    name="value1"
                    id="value1"
                    min="0"
                    value=""
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter Trade Amount"
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
                <span class="text-5xl text-blue-500 font-bold rounded-lg p-2">$</span>
                <input
                    type="text"
                    name="sum"
                    id="sum"
                    class="block h-14 w-full p-4 text-5xl text-white font-extrabold border border-blue-300 rounded-lg bg-blue-500 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    readonly
                />
            </div>
        </div>

        <div class="mb-6">
            <label class="form-label">Upload Single Card Here</label>

            <input type="file" id="singlecard_upload" class="filepond" name="singlecard_upload" multiple data-allow-reorder="true" data-max-file-size="10MB" data-max-files="1" required />
        </div>

        <div class="flex gap-2 md:mt-0 mt-4">
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Start Trade
            </button>

            <a href="{{ route('trade-multiple-card') }}" 
                class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Multiple Card? Click here
            </a>
        </div>
    </form>
</div>

@include('user.components.card_sub_category') @include('user.scripts.single_card_upload')
