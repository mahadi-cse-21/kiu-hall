<x-manager-layout>

    <div class="py-4 bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="relative overflow-hidden">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-amber-600 to-orange-600 rounded-3xl blur-lg opacity-20">
                        </div>
                        <div
                            class="relative bg-gradient-to-br from-amber-50 via-orange-50 to-amber-50 rounded-3xl p-8 border-2 border-amber-200 shadow-xl">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div
                                        class="bg-gradient-to-br from-amber-600 to-orange-600 rounded-2xl p-3 mr-4 shadow-lg">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-black bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                            Guest Meal Management
                                        </h4>
                                        <p class="text-sm text-gray-600 mt-1">Add guest meals for members</p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('guestmeal') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                    <!-- User Selection -->
                                    <div class="space-y-3">
                                        <label for="user_id"
                                            class="block text-sm font-bold text-gray-700 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Select Member
                                            <span class="ml-1 text-red-500">*</span>
                                        </label>
                                        <select name="user_id" id="user_id" required
                                            class="w-full px-4 py-3 bg-white border-2 border-amber-300 rounded-2xl focus:ring-4 focus:ring-amber-300 focus:border-amber-400 transition-all duration-300 text-gray-700 shadow-inner hover:shadow-lg appearance-none cursor-pointer">
                                            <option value="" class="text-gray-400">👤 Select the name who has guest meal
                                            </option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" class="text-gray-700 py-2">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Number of Guest Meals -->
                                    <div class="space-y-3">
                                        <label for="number_of_guest_meal"
                                            class="block text-sm font-bold text-gray-700 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Number of Guest Meals
                                            <span class="ml-1 text-red-500">*</span>
                                        </label>
                                        <input type="number" name="number_of_guest_meal" id="number_of_guest_meal"
                                            placeholder="Enter number of guest meals" min="1.0" max="10.0" step="0.5"
                                            required
                                            class="w-full px-4 py-3 bg-white border-2 border-amber-300 rounded-2xl focus:ring-4 focus:ring-amber-300 focus:border-amber-400 transition-all duration-300 text-gray-700 shadow-inner hover:shadow-lg placeholder-gray-400">
                                    </div>

                                    <div class="space-y-3">
                                        <label for="date" class="block text-sm font-bold text-gray-700">Date</label>
                                        <input type="date" name="date" id="date" value="{{ now()->format('Y-m-d') }}"
                                            class="w-full px-4 py-3 bg-white border-2 border-amber-300 rounded-2xl focus:ring-4 focus:ring-amber-300 focus:border-amber-400 transition-all duration-300 text-gray-700 shadow-inner hover:shadow-lg">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-center pt-4">
                                    <button type="submit" class="group relative overflow-hidden">
                                        <div
                                            class="absolute -inset-1 bg-gradient-to-r from-amber-600 to-orange-600 rounded-3xl blur-lg opacity-50 group-hover:opacity-75 transition duration-500">
                                        </div>
                                        <div
                                            class="relative bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-12 py-4 rounded-2xl font-bold text-sm shadow-2xl transition-all duration-500 flex items-center space-x-3 transform hover:scale-105">
                                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform duration-500"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            <span>Add Guest Meal</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</x-manager-layout>