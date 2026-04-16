@include('admin.components.header')

<div x-data="setup()" @resize.window="watchScreen()">
	<div class="flex min-h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">

		{{-- Sticky sidebar wrapper --}}
		<div class="sticky top-0 self-start h-screen flex-shrink-0 hidden sm:block">
			@include('admin.components.desktop-sidebar')
		</div>

		{{-- Mobile sidebar & backdrop (only visible on mobile via Alpine) --}}
		<div x-show="isSidebarOpen" class="fixed inset-0 z-50 flex sm:hidden">
			{{-- Backdrop --}}
			<div x-show="isSidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="isSidebarOpen = false" class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>

			{{-- Sidebar Content --}}
			@include('admin.components.sidebar-pages')
		</div>

		{{-- Mobile bottom navigation bar --}}
		@include('admin.components.mobile-sidebar')

		{{-- Main content area --}}
		<div class="flex flex-col flex-1 min-w-0">
			@include('admin.components.navbar-header')
			<div class="m-4 md:m-6">
				@yield('content')
			</div>
		</div>

	</div>
</div>

@include('admin.components.auth-footer')
