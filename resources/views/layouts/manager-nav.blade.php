<nav x-data="{ open: false }" class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo/Brand --}}
            <div class="flex-shrink-0">
                <span class="text-xl font-bold text-gray-800">Manager Portal</span>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('manager.dashboard') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('manager.dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('manager.meal-tracking') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('manager.meal-tracking') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                    Meal Tracking
                </a>
                <a href="{{ route('manager.payments') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('manager.payments') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                    Member Payment
                </a>

                <a href="{{ route('manager.bazars') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('manager.bazars') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                    Bazar Details
                </a>
                <a href="{{ route('manager.guest') }}"
                    class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('manager.guest') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">
                    Guest Meal
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="md:hidden pb-4">

            <div class="flex flex-col space-y-2">

                <a href="{{ route('manager.dashboard') }}"
                    class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('manager.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('manager.meal-tracking') }}"
                    class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('manager.meal-tracking') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Meal Tracking
                </a>

                <a href="{{ route('manager.payments') }}"
                    class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('manager.payments') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Member Payment
                </a>

                <a href="{{ route('manager.bazars') }}"
                    class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('manager.bazars') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Bazar Details
                </a>

                <a href="{{ route('manager.guest') }}"
                    class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('manager.guest') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Guest Meal
                </a>

            </div>
        </div>
    </div>
</nav>