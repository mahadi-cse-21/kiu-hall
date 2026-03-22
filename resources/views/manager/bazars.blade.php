<x-manager-layout>
    <!-- Enhanced Bazar Information Form -->
            <div class="relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 via-purple-600/5 to-pink-600/5 rounded-3xl">
                </div>
                <div class="relative bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/20">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 flex items-center mb-2">
                                <div
                                    class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-3 mr-4 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <span
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Add Bazar Entry
                                </span>
                            </h3>
                            <p class="text-gray-600 ml-20">Record your daily market purchases</p>
                        </div>
                    </div>

                    <form action="{{ route('addbazar') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Description Section -->
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl blur-lg opacity-20 group-hover:opacity-30 transition duration-500">
                            </div>
                            <div
                                class="relative bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-3xl p-8 border border-blue-200 shadow-lg">
                                <div class="flex items-center space-x-3 mb-5">
                                    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl p-3 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h7" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-800">Items Description</h4>
                                </div>
                                <textarea name="description" id="description" rows="5"
                                    placeholder="📝 List all items purchased today... "
                                    class="w-full px-6 py-5 bg-white/80 backdrop-blur-sm border-2 border-blue-200 rounded-2xl focus:ring-4 focus:ring-blue-300 focus:border-blue-400 transition-all duration-300 resize-none text-gray-700 placeholder-gray-400 shadow-inner hover:shadow-lg"
                                    required></textarea>
                                <div class="mt-4 flex items-center justify-between">
                                    <span
                                        class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">Required
                                        field</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Cost Section -->
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-3xl blur-lg opacity-20 group-hover:opacity-30 transition duration-500">
                                </div>
                                <div
                                    class="relative bg-gradient-to-br from-emerald-50 via-teal-50 to-emerald-50 rounded-3xl p-8 border border-emerald-200 shadow-lg">
                                    <div class="flex items-center space-x-3 mb-5">
                                        <h4 class="text-sm font-bold text-gray-800">Cost Details</h4>
                                    </div>
                                    <div class="space-y-6">
                                        <div>
                                            <label for="amount"
                                                class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                                Total Amount
                                                <span class="ml-2 text-red-500 text-lg">*</span>
                                            </label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute -inset-0.5 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-2xl blur opacity-0 group-hover/input:opacity-30 transition duration-300">
                                                </div>
                                                <div class="relative">
                                                    <span
                                                        class="absolute left-6 top-1/2 transform -translate-y-1/2 text-3xl font-black text-emerald-600">৳</span>
                                                    <input type="number" name="amount" id="total_cost"
                                                        placeholder="0.00"
                                                        class="w-full pl-16 pr-8 py-5 bg-white border-2 border-emerald-300 rounded-2xl focus:ring-4 focus:ring-emerald-300 focus:border-emerald-400 transition-all duration-300 text-2xl font-bold text-gray-800 shadow-inner hover:shadow-lg"
                                                        step="0.01" min="0" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="date"
                                                class="block text-sm font-bold text-gray-700 mb-3">Purchase Date</label>
                                            <div class="relative">
                                                <input type="date" name="date" id="date"
                                                    class="w-full px-6 py-4 bg-white border-2 border-emerald-300 rounded-2xl focus:ring-4 focus:ring-emerald-300 focus:border-emerald-400 transition-all duration-300 text-gray-700 shadow-inner hover:shadow-lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Responsible Person Section -->
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl blur-lg opacity-20 group-hover:opacity-30 transition duration-500">
                                </div>
                                <div
                                    class="relative bg-gradient-to-br from-purple-50 via-pink-50 to-purple-50 rounded-3xl p-8 border border-purple-200 shadow-lg">
                                    <div class="flex items-center space-x-3 mb-5">
                                        <div
                                            class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl p-3 shadow-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-sm font-bold text-gray-800">Responsible Person</h4>
                                    </div>
                                    <div class="space-y-6">
                                        <div>
                                            <label for="name"
                                                class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                                Select Person
                                                <span class="ml-2 text-red-500 text-lg">*</span>
                                            </label>
                                            <div class="relative group/select">
                                                <select name="names" id="name"
                                                    class="w-full px-6 py-5 bg-white border-2 border-purple-300 rounded-2xl focus:ring-4 focus:ring-purple-300 focus:border-purple-400 transition-all duration-300 text-gray-700 shadow-inner hover:shadow-lg appearance-none cursor-pointer text-lg font-semibold"
                                                    required>
                                                    <option value="" class="text-gray-400">👤 Choose who went to market
                                                    </option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->name }}" class="text-gray-700 py-2">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <svg class="absolute right-5 top-1/2 transform -translate-y-1/2 w-6 h-6 text-purple-500 pointer-events-none"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center pt-8">
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
                                    <span>Save Bazar Entry</span>
                                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
</x-manager-layout>