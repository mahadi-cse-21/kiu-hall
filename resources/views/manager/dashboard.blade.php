<x-manager-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Header Section --}}
            <div class="text-left mb-8">
                <h1 class="text-4xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Dashboard Overview
                </h1>
                <p class="text-gray-600 mt-2">Welcome back! Here's your meal management summary for today</p>
            </div>

            {{-- Key Metrics Row --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Meals Today -->
                <div class="group relative overflow-hidden">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl blur-lg opacity-25 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-white/20 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Total Meals Today</p>
                                <p class="text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ ($today_breakfast ?? 0) + ($today_lunch ?? 0) + ($today_dinner ?? 0) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">Across all time slots</p>
                            </div>
                            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full w-full"></div>
                    </div>
                </div>

                <!-- Active Users -->
                <div class="group relative overflow-hidden">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-400 rounded-2xl blur-lg opacity-25 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-white/20 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Active Users</p>
                                <p class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                    {{ isset($users) ? $users->where('status', 'active')->count() : 0 }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">out of {{ isset($users) ? $users->count() : 0 }} total</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full w-2/3"></div>
                    </div>
                </div>

                
            </div>

            {{-- Today's Meal Breakdown Section --}}
            <div class="relative overflow-hidden">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl blur-lg opacity-20"></div>
                <div class="relative bg-gradient-to-br from-white to-indigo-50/50 rounded-3xl p-8 border-2 border-indigo-200 shadow-xl">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-3 mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Today's Meal Breakdown
                                </h4>
                                <p class="text-gray-500 text-sm mt-1">Detailed distribution by meal type</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                    </div>
                    
                    {{-- Meal Count Cards with Progress Bars --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Breakfast -->
                        <div class="group relative overflow-hidden">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                            <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 rounded-xl p-3 mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold text-gray-800">Breakfast</div>
                                            <div class="text-xs text-gray-500">Morning meal</div>
                                        </div>
                                    </div>
                                    <div class="text-4xl font-black text-blue-600">
                                        {{ $today_breakfast ?? 0 }}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Meal count</span>
                                        <span>{{ $today_breakfast ?? 0 }} / {{ $activeUsers ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php $breakfastPercent = ($activeUsers ?? 1) > 0 ? (($today_breakfast ?? 0) / ($activeUsers ?? 1)) * 100 : 0; @endphp
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-500" style="width: {{ $breakfastPercent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lunch -->
                        <div class="group relative overflow-hidden">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                            <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 rounded-xl p-3 mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold text-gray-800">Lunch</div>
                                            <div class="text-xs text-gray-500">Afternoon meal</div>
                                        </div>
                                    </div>
                                    <div class="text-4xl font-black text-green-600">
                                        {{ $today_lunch ?? 0 }}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Meal count</span>
                                        <span>{{ $today_lunch ?? 0 }} / {{ $activeUsers ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php $lunchPercent = ($activeUsers ?? 1) > 0 ? (($today_lunch ?? 0) / ($activeUsers ?? 1)) * 100 : 0; @endphp
                                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full transition-all duration-500" style="width: {{ $lunchPercent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dinner -->
                        <div class="group relative overflow-hidden">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                            <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="bg-purple-100 rounded-xl p-3 mr-3">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold text-gray-800">Dinner</div>
                                            <div class="text-xs text-gray-500">Evening meal</div>
                                        </div>
                                    </div>
                                    <div class="text-4xl font-black text-purple-600">
                                        {{ $today_dinner ?? 0 }}
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Meal count</span>
                                        <span>{{ $today_dinner ?? 0 }} / {{ $activeUsers ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php $dinnerPercent = ($activeUsers ?? 1) > 0 ? (($today_dinner ?? 0) / ($activeUsers ?? 1)) * 100 : 0; @endphp
                                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-500" style="width: {{ $dinnerPercent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Stats Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-4 border-t border-indigo-200">
                        <div class="flex items-center justify-between p-4 bg-white/50 rounded-xl">
                            <div>
                                <p class="text-sm text-gray-500">Most Popular Meal</p>
                                @php
                                    $meals = [
                                        'Breakfast' => $today_breakfast ?? 0,
                                        'Lunch' => $today_lunch ?? 0,
                                        'Dinner' => $today_dinner ?? 0
                                    ];
                                    $mostPopular = array_keys($meals, max($meals))[0] ?? 'No data';
                                    $popularCount = max($meals) ?? 0;
                                @endphp
                                <p class="text-xl font-bold text-gray-800">{{ $mostPopular }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-black text-indigo-600">{{ $popularCount }}</p>
                                <p class="text-xs text-gray-500">meals ordered</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white/50 rounded-xl">
                            <div>
                                <p class="text-sm text-gray-500">Peak Meal Time</p>
                                @php
                                    $peakTime = $popularCount > 0 ? $mostPopular : 'No data';
                                @endphp
                                <p class="text-xl font-bold text-gray-800">{{ $peakTime }}</p>
                            </div>
                            <div class="text-right">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-manager-layout>