<nav aria-label="Options" class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 sm:hidden shadow-t rounded-t-3xl">
    <!-- Menu button -->
    <button
        @click="(isSidebarOpen &amp;&amp; currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
        class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2 text-gray-500 bg-white"
        :class="(isSidebarOpen &amp;&amp; currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
    >
        <span class="sr-only">Toggle sidebar</span>
        <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
        </svg>
    </button>

    <!-- Logo -->
    <a href="{{ route('user') }}">
        <img class="w-10 h-auto" src="/images/yuwantrade_logo.png" alt="YuwangTrade" />
    </a>

    <!-- User avatar button -->
    <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
        <button
            @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
            class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
        >
          
        </button>
        <div
            x-show="isOpen"
            @click.away="isOpen = false"
            @keydown.escape="isOpen = false"
            x-ref="userMenu"
            tabindex="-1"
            class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-label="user menu"
            style="display: none;"
        >
            

            <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
        </div>
    </div>
</nav>
