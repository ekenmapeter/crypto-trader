<div
    x-transition:enter="transform transition-transform duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition-transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    x-show="isSidebarOpen"
    class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-72 bg-white border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64"
>
    <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center flex-shrink-0 py-10">
            <a href="{{ route('user') }}">
                <img class="w-28 h-auto" src="/images/logo.png" alt="coinmexer" />
            </a>
        </div>

        <!-- Links -->
        <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
            <a href="/" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 ">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                </span>
                <span>Home</span>
            </a>
            <a href="{{ route('user') }}" class="flex items-center w-full space-x-2 text-white bg-indigo-600 rounded-lg">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                   <i class="fa fa-tachometer" aria-hidden="true"></i>

                </span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('user-activities') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                    <i class="fa fa-history" aria-hidden="true"></i>
                </span>
                <span>Activities</span>
            </a>

            <a href="{{ route('user-transactions') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                    <i class="fa fa-exchange" aria-hidden="true"></i>
                </span>
                <span>Transactions</span>
            </a>

            <a href="{{ route('user-transactions') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </span>
                <span>Notifications</span>
            </a>

            <a href="{{ route('account-settings') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </span>
                <span>Account Settings</span>
            </a>

            <a href="{{ route('withdraw') }}" class="flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white">
                <span aria-hidden="true" class="p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </span>
                <span>Withdraw Funds</span>
            </a>

        </div>

        <div class="flex-shrink-0 p-4 mt-2">
            <div class="p-2 space-y-6 bg-gray-100 rounded-lg md:block">
                <div class="flex items-center gap-2 mb-8">

                    <a href="{{ url('crypto') }}" class="w-full px-2 py-2 text-center text-white transition-colors bg-blue-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100">Sell Crypto</a>
                    <a href="{{ url('buy') }}" class="w-full px-2 py-2 text-center text-white transition-colors bg-yellow-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100">Buy Crypto</a>

                </div>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-center text-white transition-colors bg-red-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </nav>


    @include('user.panel.notifications')
</div>
