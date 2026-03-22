<x-app-layout>
    <x-slot name="header">
        <div class="">
            <h2
                class="font-bold text-xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 bg-clip-text text-transparent">
                {{ __('My Dashboard') }}
            </h2>

            <span class="text-sm text-gray-600">
                Meal Floor {{ $meal_floor }}
            </span>
        </div>
    </x-slot>

    <div class="py-8 p-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Meals -->
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-white/20 rounded-xl p-3 backdrop-blur-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">{{ $total_meal }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Total Meals</h3>
                    <p class="text-purple-100 text-sm">This month</p>
                </div>

                <!-- Total Paid -->
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-white/20 rounded-xl p-3 backdrop-blur-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">৳{{ number_format($payment_stats['total_paid'], 2) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Total Paid</h3>
                    <p class="text-green-100 text-sm">All payments</p>
                </div>

                <!-- This Week Meals -->
                <div
                    class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-white/20 rounded-xl p-3 backdrop-blur-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">{{ $total_week_meal }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">This Week</h3>
                    <p class="text-orange-100 text-sm">Meals taken</p>
                </div>

                <!-- Amount Due -->
                <div
                    class="bg-gradient-to-br from-{{ $amount_due > 0 ? 'red' : 'blue' }}-500 to-{{ $amount_due > 0 ? 'red' : 'blue' }}-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-white/20 rounded-xl p-3 backdrop-blur-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($amount_due > 0)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                @endif
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">৳{{ number_format(abs($amount_due), 2) }}</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">
                        {{ $amount_due > 0 ? 'Amount Due' : 'Overpaid' }}
                    </h3>
                    <p class="text-{{ $amount_due > 0 ? 'red' : 'blue' }}-100 text-sm">
                        {{ $amount_due > 0 ? 'Payment pending' : 'Credit available' }}
                    </p>
                </div>
            </div>

            <!-- Payment Summary Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Payment Summary
                    </h3>
                    <a href="" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        View History
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <!-- Total Paid -->
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-800">Total Paid</p>
                                <p class="text-2xl font-bold text-green-900">
                                    ৳{{ number_format($payment_stats['total_paid'], 2) }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Due -->
                    <div
                        class="bg-{{ $amount_due > 0 ? 'red' : 'green' }}-50 rounded-xl p-4 border border-{{ $amount_due > 0 ? 'red' : 'green' }}-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-{{ $amount_due > 0 ? 'red' : 'green' }}-800">
                                    {{ $amount_due > 0 ? 'Amount Due' : 'Credit' }}
                                </p>
                                <p class="text-2xl font-bold text-{{ $amount_due > 0 ? 'red' : 'green' }}-900">
                                    ৳{{ number_format(abs($amount_due), 2) }}
                                </p>
                            </div>
                            <div class="bg-{{ $amount_due > 0 ? 'red' : 'green' }}-100 rounded-full p-2">
                                <svg class="w-6 h-6 text-{{ $amount_due > 0 ? 'red' : 'green' }}-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $amount_due > 0 ? 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Last Payment -->
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-800">Last Payment</p>
                                <p class="text-lg font-bold text-blue-900">
                                    @if($payment_stats['last_payment'])
                                        ৳{{ number_format($payment_stats['last_payment']->amount, 2) }}
                                    @else
                                        No payments
                                    @endif
                                </p>
                                <p class="text-xs text-blue-600 mt-1">
                                    @if($payment_stats['last_payment'])
                                        {{ \Carbon\Carbon::parse($payment_stats['last_payment']->date)->format('M d, Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments -->
                @if($myPayments->count() > 0)
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-700 mb-3">Recent Payments</h4>
                        <div class="space-y-2">
                            @foreach($myPayments->take(3) as $payment)
                                <div
                                    class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-green-100 rounded-full p-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                ৳{{ number_format($payment->amount, 2) }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    @if($payment->notes)
                                        <span class="text-xs text-gray-500 truncate max-w-xs">{{ $payment->notes }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-4 bg-gray-50 rounded-lg">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 text-sm">No payment history found</p>
                    </div>
                @endif

                <!-- Payment Breakdown -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4 border border-purple-200">
                    <h4 class="text-md font-semibold text-gray-700 mb-3">Payment Breakdown</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Paid</span>
                            <span
                                class="font-bold text-green-600">৳{{ number_format($payment_stats['total_paid'], 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Meals Cost</span>
                            <span
                                class="font-bold text-gray-900">-৳{{ number_format($total_meal * $cost_per_meal, 2) }}</span>
                        </div>

                        <div class="border-t border-gray-300 pt-2">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">
                                    {{ $amount_due > 0 ? 'Amount Due' : 'Credit' }}
                                </span>
                                <span
                                    class="text-xl font-bold {{ $amount_due > 0 ? 'text-red-600' : 'text-green-600' }}">
                                    ৳{{ number_format(abs($amount_due), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meal Off Form -->
            <form action="{{ route('saveMealOff') }}" method="post"
                class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                @csrf
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Meal Off Request
                    </h3>
                    <p class="text-gray-600 text-sm">Select the date range when you won't be taking meals</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                            From Date
                        </label>
                        <input type="date" name="start_date" id="start_date"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                            min="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                            To Date
                        </label>
                        <input type="date" name="end_date" id="end_date"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                            min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Meal Types -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select Meals to Skip</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Breakfast -->
                        <div
                            class="flex items-center space-x-3 p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border-2 border-red-200 hover:border-red-300 transition-all duration-300">
                            <input type="checkbox" name="meals[]" value="breakfast" id="off_breakfast"
                                class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                            <label for="off_breakfast" class="flex items-center space-x-3 cursor-pointer">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16m-7 6h7"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-700">Breakfast</span>
                            </label>
                        </div>

                        <!-- Lunch -->
                        <div
                            class="flex items-center space-x-3 p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border-2 border-red-200 hover:border-red-300 transition-all duration-300">
                            <input type="checkbox" name="meals[]" value="lunch" id="off_lunch"
                                class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                            <label for="off_lunch" class="flex items-center space-x-3 cursor-pointer">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-700">Lunch</span>
                            </label>
                        </div>

                        <!-- Dinner -->
                        <div
                            class="flex items-center space-x-3 p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border-2 border-red-200 hover:border-red-300 transition-all duration-300">
                            <input type="checkbox" name="meals[]" value="dinner" id="off_dinner"
                                class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                            <label for="off_dinner" class="flex items-center space-x-3 cursor-pointer">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="font-semibold text-gray-700">Dinner</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Reason (Optional) -->
                <div class="mb-6">
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Reason (Optional)
                    </label>
                    <textarea name="reason" id="reason" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                        placeholder="Let us know why you'll be away..."></textarea>
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Submit Meal Off Request
                </button>
            </form>

            <!-- Meal Form -->
            <form action="{{ route('saveMeal') }}" method="post"
                class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                @csrf
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Today's Meals Selection
                    </h3>
                </div>

                @php
                    $timezone = config('app.timezone');
                    $now = \Carbon\Carbon::now($timezone);
                    $today = \Carbon\Carbon::today($timezone);

                    $breakfastCutoff = $today->copy()->setHour(7);   // 7 AM
                    $lunchCutoff = $today->copy()->setHour(12);      // 12 PM
                    $dinnerCutoff = $today->copy()->setHour(18);     // 6 PM
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Breakfast -->
                    <div
                        class="flex items-center space-x-4 p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-300 transition-all duration-300">
                        <input type="checkbox" name="breakfast" id="breakfast" {{ optional($todayMeal)->breakfast ? 'checked' : '' }}
                            class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                        <label for="breakfast" class="flex items-center space-x-3 cursor-pointer">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Breakfast</span>
                        </label>
                    </div>

                    <!-- Lunch -->
                    <div
                        class="flex items-center space-x-4 p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl border-2 border-orange-200 hover:border-orange-300 transition-all duration-300">
                        <input type="checkbox" name="lunch" id="lunch" {{ optional($todayMeal)->lunch ? 'checked' : '' }}
                            class="w-5 h-5 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 focus:ring-2">
                        <label for="lunch" class="flex items-center space-x-3 cursor-pointer">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Lunch</span>
                        </label>
                    </div>

                    <!-- Dinner -->
                    <div
                        class="flex items-center space-x-4 p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-300 transition-all duration-300">
                        <input type="checkbox" name="dinner" id="dinner" {{ optional($todayMeal)->dinner ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="dinner" class="flex items-center space-x-3 cursor-pointer">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Dinner</span>
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Today's Meals
                </button>
            </form>

        </div>
    </div>

    <script>
        // Show notification
        function showNotification(message, type = 'success') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            document.querySelectorAll('.custom-notification').forEach(n => n.remove());

            const notification = document.createElement('div');
            notification.className = `custom-notification fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex items-center space-x-2`;

            const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : '⚠';
            notification.innerHTML = `<span class="font-bold">${icon}</span><span>${message}</span>`;

            document.body.appendChild(notification);

            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Date validation for meal off form
        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Set end date min to start date when start date changes
            startDateInput.addEventListener('change', function () {
                endDateInput.min = this.value;
                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = this.value;
                }
            });

            // Set start date max to end date when end date changes
            endDateInput.addEventListener('change', function () {
                startDateInput.max = this.value;
                if (startDateInput.value && startDateInput.value > this.value) {
                    startDateInput.value = this.value;
                }
            });

            const toggles = document.querySelectorAll('input[type="checkbox"]');
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function () {
                    const mealType = this.name;
                    const status = this.checked ? 'ON' : 'OFF';
                    console.log(`${mealType}: ${status}`);
                });
            });
        });
    </script>
</x-app-layout>