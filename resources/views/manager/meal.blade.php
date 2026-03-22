<x-manager-layout>
     <!-- Monthly Meal Tracking Section -->
            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-purple-600/5 rounded-3xl"></div>
                <div class="relative bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 flex items-center mb-2">
                                <div
                                    class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-3 mr-4 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Monthly Meal Tracking
                                </span>
                            </h3>
                            <p class="text-gray-600 ml-20">{{ now()->format('F Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl px-6 py-3 border border-indigo-200">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">{{ now()->daysInMonth }}</div>
                                    <div class="text-xs text-gray-600">Days in Month</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Meal Table -->
                    <form action="{{ route('updatemeal') }}" method="POST">
                        @csrf

                        <div class="overflow-hidden rounded-2xl border-2 border-gray-200 shadow-xl">
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs border-collapse">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-gray-100 to-gray-200">
                                            <th
                                                class="sticky left-0 z-20 bg-gradient-to-r from-gray-100 to-gray-200 border-r border-gray-300 py-2 px-3 font-bold text-gray-800 text-left min-w-[120px]">
                                                <div class="flex items-center space-x-1">
                                                    <span>User Name</span>
                                                </div>
                                            </th>

                                            @php
                                                $daysInMonth = now()->daysInMonth;
                                                $currentMonth = now()->month;
                                                $currentYear = now()->year;
                                            @endphp

                                            @for($day = 1; $day <= $daysInMonth; $day++)
                                                @php
                                                    $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day);
                                                    $isToday = $date->isToday();
                                                    $isPast = $date->isPast() && !$isToday;
                                                    $isFuture = $date->isFuture();
                                                @endphp

                                                <th
                                                    class="border-l border-gray-300 py-3 px-2 text-center min-w-[140px] {{ $isToday ? 'bg-gradient-to-br from-indigo-100 to-purple-100' : ($isPast ? 'bg-gray-50' : 'bg-white') }}">
                                                    <div class="flex flex-col items-center space-y-2">
                                                        <div class="flex items-center justify-center space-x-1">
                                                            <span
                                                                class="font-bold text-lg {{ $isToday ? 'text-indigo-600' : 'text-gray-700' }}">{{ $day }}</span>
                                                            @if($isToday)
                                                                <span
                                                                    class="bg-indigo-600 text-white text-xs px-2 py-0.5 rounded-full font-bold">Today</span>
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="text-xs font-medium {{ $isToday ? 'text-indigo-600' : 'text-gray-500' }}">
                                                            {{ $date->format('D') }}
                                                        </div>

                                                        <!-- Meal Type Headers -->
                                                        <div class="grid grid-cols-3 gap-1 w-full mt-2">
                                                            <div class="bg-blue-50 rounded px-1 py-1">
                                                                <div class="text-[10px] font-semibold text-blue-700">B</div>
                                                            </div>
                                                            <div class="bg-green-50 rounded px-1 py-1">
                                                                <div class="text-[10px] font-semibold text-green-700">L
                                                                </div>
                                                            </div>
                                                            <div class="bg-purple-50 rounded px-1 py-1">
                                                                <div class="text-[10px] font-semibold text-purple-700">D
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                            @endfor

                                            <th
                                                class="border-l border-gray-300 py-2 px-2 font-bold text-gray-800 text-center min-w-[80px]">
                                                <div class="flex flex-col items-center space-y-1">
                                                    <span class="text-xs">Total</span>
                                                    <div class="text-[10px] font-medium text-gray-500">Meals</div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            @php
                                                $userTotalMeals = 0;
                                            @endphp
                                            <tr class="bg-gray-50 hover:bg-indigo-50/30 transition-all duration-300">
                                                <td
                                                    class="sticky left-0 z-10 bg-gray-50 hover:bg-indigo-50/30 border-r border-t border-gray-300 py-2 px-3 font-semibold text-gray-800">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-lg flex-shrink-0">
                                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                                        </div>
                                                        <span
                                                            class="text-gray-900 font-semibold text-xs">{{ $user->name }}</span>
                                                    </div>
                                                </td>

                                                @for($day = 1; $day <= $daysInMonth; $day++)
                                                    @php
                                                        $date = \Carbon\Carbon::create($currentYear, $currentMonth, $day);
                                                        $dateStr = $date->format('Y-m-d');
                                                        $isToday = $date->isToday();

                                                        // Get meal data for this user and date
                                                        $dayMeal = $meals->where('user_id', $user->id)
                                                            ->where('date', $date)
                                                            ->first();

                                                        $breakfast = $dayMeal ? ($dayMeal->breakfast ?? false) : false;
                                                        $lunch = $dayMeal ? ($dayMeal->lunch ?? false) : false;
                                                        $dinner = $dayMeal ? ($dayMeal->dinner ?? false) : false;

                                                        // Calculate daily meals for this user
                                                        $dailyMeals = 0;
                                                        if ($breakfast)
                                                            $dailyMeals += 0.5;
                                                        if ($lunch)
                                                            $dailyMeals++;
                                                        if ($dinner)
                                                            $dailyMeals++;

                                                        $userTotalMeals += $dailyMeals;
                                                    @endphp

                                                    <td
                                                        class="border-l border-t border-gray-300 py-3 px-2 text-center {{ $isToday ? 'bg-indigo-50/50' : '' }}">
                                                        <div class="grid grid-cols-3 gap-1">
                                                            <!-- Breakfast Toggle -->
                                                            <div class="flex justify-center">
                                                                <label class="relative inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox"
                                                                        name="meals[{{ $user->id }}][{{ $dateStr }}][breakfast]"
                                                                        value="1" {{ $breakfast ? 'checked' : '' }}
                                                                        class="sr-only peer">
                                                                    <div
                                                                        class="w-10 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500 shadow-sm">
                                                                    </div>
                                                                </label>
                                                            </div>

                                                            <!-- Lunch Toggle -->
                                                            <div class="flex justify-center">
                                                                <label class="relative inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox"
                                                                        name="meals[{{ $user->id }}][{{ $dateStr }}][lunch]"
                                                                        value="1" {{ $lunch ? 'checked' : '' }}
                                                                        class="sr-only peer">
                                                                    <div
                                                                        class="w-10 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500 shadow-sm">
                                                                    </div>
                                                                </label>
                                                            </div>

                                                            <!-- Dinner Toggle -->
                                                            <div class="flex justify-center">
                                                                <label class="relative inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox"
                                                                        name="meals[{{ $user->id }}][{{ $dateStr }}][dinner]"
                                                                        value="1" {{ $dinner ? 'checked' : '' }}
                                                                        class="sr-only peer">
                                                                    <div
                                                                        class="w-10 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-purple-500 shadow-sm">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <!-- Daily meal count badge -->
                                                        @if($dailyMeals > 0)
                                                            <div class="mt-2">
                                                                <span
                                                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full">
                                                                    {{ $dailyMeals }}
                                                                </span>
                                                            </div>
                                                        @endif

                                                        <!-- Hidden input for user_id -->
                                                        <input type="hidden"
                                                            name="meals[{{ $user->id }}][{{ $dateStr }}][user_id]"
                                                            value="{{ $user->id }}">
                                                        <input type="hidden" name="meals[{{ $user->id }}][{{ $dateStr }}][date]"
                                                            value="{{ $dateStr }}">
                                                    </td>
                                                @endfor

                                                <!-- Total Meals Cell -->
                                                <td
                                                    class="border-l border-t border-gray-300 py-2 px-2 text-center font-bold text-gray-800 bg-gray-50 hover:bg-indigo-50/30">
                                                    <div class="flex flex-col items-center justify-center space-y-1">
                                                        <div
                                                            class="text-lg font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                                            {{ $userTotalMeals }}
                                                        </div>
                                                        <div class="text-[10px] text-gray-500">meals</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-8">
                            <button type="submit" class="group relative overflow-hidden">
                                <div
                                    class="absolute -inset-2 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl blur-xl opacity-50 group-hover:opacity-75 transition duration-500 animate-pulse">
                                </div>
                                <div
                                    class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white px-16 py-5 rounded-2xl font-black text-sm shadow-2xl transition-all duration-500 flex items-center space-x-4 transform hover:scale-105">
                                    <svg class="w-7 h-7 group-hover:rotate-12 transition-transform duration-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Save All Meal Changes</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>

                    <!-- Legend -->
                    <div class="mt-8 bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                        <div class="flex flex-wrap gap-8 justify-center items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold text-blue-700 bg-blue-100 px-2 py-1 rounded">B</span>
                                <span class="text-sm font-semibold text-gray-700">Breakfast</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold text-green-700 bg-green-100 px-2 py-1 rounded">L</span>
                                <span class="text-sm font-semibold text-gray-700">Lunch</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold text-purple-700 bg-purple-100 px-2 py-1 rounded">D</span>
                                <span class="text-sm font-semibold text-gray-700">Dinner</span>
                            </div>
                            <div class="h-6 w-px bg-gray-300"></div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-5 bg-green-500 rounded-full relative shadow-sm">
                                    <div class="absolute top-[2px] right-[2px] bg-white rounded-full h-4 w-4"></div>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">ON</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-5 bg-gray-300 rounded-full relative shadow-sm">
                                    <div class="absolute top-[2px] left-[2px] bg-white rounded-full h-4 w-4"></div>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">OFF</span>
                            </div>
                            <div class="h-6 w-px bg-gray-300"></div>
                            <div class="flex items-center space-x-2">
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full">3</span>
                                <span class="text-sm font-semibold text-gray-700">Daily Meals</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-manager-layout>