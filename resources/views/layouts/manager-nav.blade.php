<nav class="bg-white shadow-md">
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
                <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4">
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

<script>
    // Pure JavaScript for mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                // Toggle the menu visibility
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    // Add animation classes
                    mobileMenu.classList.add('transition', 'ease-out', 'duration-200', 'opacity-0', 'scale-95');
                    
                    // Force reflow
                    mobileMenu.offsetHeight;
                    
                    mobileMenu.classList.remove('opacity-0', 'scale-95');
                    mobileMenu.classList.add('opacity-100', 'scale-100');
                } else {
                    mobileMenu.classList.remove('opacity-100', 'scale-100');
                    mobileMenu.classList.add('opacity-0', 'scale-95');
                    
                    // Wait for animation to complete before hiding
                    setTimeout(function() {
                        if (mobileMenu.classList.contains('opacity-0')) {
                            mobileMenu.classList.add('hidden');
                        }
                        mobileMenu.classList.remove('transition', 'ease-out', 'duration-200', 'opacity-0', 'scale-95', 'opacity-100', 'scale-100');
                    }, 200);
                }
            });
            
            // Optional: Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('opacity-100', 'scale-100');
                        mobileMenu.classList.add('opacity-0', 'scale-95');
                        
                        setTimeout(function() {
                            if (mobileMenu.classList.contains('opacity-0')) {
                                mobileMenu.classList.add('hidden');
                            }
                            mobileMenu.classList.remove('transition', 'ease-out', 'duration-200', 'opacity-0', 'scale-95', 'opacity-100', 'scale-100');
                        }, 200);
                    }
                }
            });
        }
    });
</>

<style>
    /* Smooth transition for mobile menu */
    .transition {
        transition: all 0.2s ease-in-out;
    }
    
    .duration-200 {
        transition-duration: 200ms;
    }
    
    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
    
    .opacity-0 {
        opacity: 0;
    }
    
    .opacity-100 {
        opacity: 1;
    }
    
    .scale-95 {
        transform: scale(0.95);
    }
    
    .scale-100 {
        transform: scale(1);
    }
    
    .hidden {
        display: none;
    }
</style>