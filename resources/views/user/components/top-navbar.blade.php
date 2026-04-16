<header class="bg-gradient-to-r from-[#0a3d91] to-[#1258c4] p-6 flex justify-between items-center relative shadow-lg">
    <div>
        <p class="text-sm text-blue-100">Welcome Back</p>
        <h1 class="text-xl font-bold">{{ auth()->user()->username }}</h1>
    </div>
    <div class="relative">
        <button id="userMenuBtn"
            class="w-10 h-10 rounded-full bg-black flex items-center justify-center focus:outline-none">
            <i class="fa fa-user text-white"></i>
        </button>
        <!-- Dropdown -->
        <div id="userDropdown"
            class="hidden absolute right-0 mt-2 w-56 bg-white text-black rounded-lg shadow-xl overflow-hidden z-50">
            <a href="{{ route('account-settings') }}"
                class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 text-sm">
                <i class="fa-regular fa-user"></i>
                <span>Account</span>
            </a>
            <button id="headerDarkToggle"
                class="w-full flex items-center justify-between px-4 py-3 hover:bg-gray-100 text-sm">
                <span class="flex items-center gap-2">
                    <i class="fa-regular fa-moon"></i>
                    <span>Dark Mode</span>
                </span>
                <span class="inline-flex items-center"><span class="w-9 h-5 bg-gray-300 rounded-full relative"><span
                            id="darkToggleKnob"
                            class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-all"></span></span></span>
            </button>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-4 py-3 hover:bg-gray-100 text-sm text-red-600">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</header>
