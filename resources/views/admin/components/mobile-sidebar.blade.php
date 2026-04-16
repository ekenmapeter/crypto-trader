{{-- Modern mobile bottom navigation bar --}}
<nav aria-label="Mobile Navigation" 
    class="fixed inset-x-0 bottom-0 z-40 bg-gray-900/80 backdrop-blur-xl border-t border-gray-800 sm:hidden rounded-t-[32px] px-6 py-3 shadow-[0_-10px_40px_rgba(0,0,0,0.4)]">
    
    <div class="flex items-center justify-between">
        
        {{-- Home --}}
        <a href="{{ route('administrator') }}" class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-2xl transition-all {{ request()->routeIs('administrator') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-gray-500 hover:text-gray-300' }}">
                <i class="fa-solid fa-house-chimney text-lg"></i>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('administrator') ? 'text-blue-400' : 'text-gray-500' }}">Home</span>
        </a>

        {{-- Transactions --}}
        <a href="{{ route('transactions') }}" class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-2xl transition-all {{ request()->routeIs('transactions') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-gray-500 hover:text-gray-300' }}">
                <i class="fa-solid fa-receipt text-lg"></i>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('transactions') ? 'text-blue-400' : 'text-gray-500' }}">History</span>
        </a>

        {{-- Main Menu Toggle --}}
        <button @click="isSidebarOpen = true; currentSidebarTab = 'linksTab'" class="flex flex-col items-center gap-1 -mt-8 relative group">
            <div class="w-14 h-14 bg-gradient-to-tr from-blue-700 to-blue-500 rounded-full flex items-center justify-center text-white shadow-xl shadow-blue-600/40 border-4 border-gray-900 group-active:scale-90 transition-transform">
                <i class="fa-solid fa-grid-2 text-xl"></i>
            </div>
            <span class="text-[10px] font-bold text-blue-400 mt-1">Menu</span>
        </button>

        {{-- Users --}}
        <a href="{{ route('allusers') }}" class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-2xl transition-all {{ request()->routeIs('allusers') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-gray-500 hover:text-gray-300' }}">
                <i class="fa-solid fa-users text-lg"></i>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('allusers') ? 'text-blue-400' : 'text-gray-500' }}">Users</span>
        </a>

        {{-- Settings --}}
        <a href="{{ route('admin-settings') }}" class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-2xl transition-all {{ request()->routeIs('admin-settings') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-gray-500 hover:text-gray-300' }}">
                <i class="fa-solid fa-sliders text-lg"></i>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('admin-settings') ? 'text-blue-400' : 'text-gray-500' }}">Config</span>
        </a>

    </div>

</nav>
