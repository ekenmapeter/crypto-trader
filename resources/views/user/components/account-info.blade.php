<section class="grid md:grid-cols-4 grid-cols-2 gap-2 m-4 md:-mt-2 grid-flow-row grid-">
        <div class="md:flex grid-cols-1 items-center md:h-12 md:p-8 p-8 bg-blue-500 shadow rounded-lg">
          <div class="hidden md:inline-flex flex-shrink-0 items-center justify-center h-8 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/> <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/> </svg>
          </div>
          <div>
            <span class="block text-2xl text-white font-bold">Welcome! </span>
            <span class="block text-white font-semibold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          </div>
        </div>
        <div class="md:flex grid-cols-1 items-center md:h-12 md:p-8 p-4 bg-white shadow rounded-lg">
          <div class="hidden md:inline-flex flex-shrink-0 items-center justify-center h-8 w-16 text-green-600 bg-green-100 rounded-full mr-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16"> <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/> </svg>
          </div>
          <div>
            <span class="block md:text-1xl text-sm font-bold">Wallet</span>
            <span class="block font-bold text-black">₦ {{ number_format($user_amount, 2) }}</span>
          </div>
        </div>
        <div class="md:flex grid-cols-1 items-center md:h-12 md:p-8 p-4 bg-indigo-500 shadow rounded-lg">
          <div class="hidden md:inline-flex flex-shrink-0 items-center justify-center h-8 w-16 text-red-600 bg-red-100 rounded-full mr-6">
            <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" fill="blue"></path> </svg>
          </div>
          <div>
            <span class="inline-block text-1xl text-white font-bold">Transactions</span><br>
            <span class="inline-block text-xl text-white font-semibold">{{ $totalTransactions }}</span>
          </div>
        </div>
        <div class="md:flex grid-cols-1  items-center md:h-12 md:p-8 p-4 bg-white shadow rounded-lg">
          <div class="hidden md:inline-flex flex-shrink-0 items-center justify-center h-8 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
          </div>
          <div>
            <span class="block text-1xl font-bold">Last Login</span>
            <span class="block text-gray-500">{{ \Carbon\Carbon::parse(Auth::user()->last_login)->diffForHumans() }}
             </span>
          </div>
        </div>
      </section>