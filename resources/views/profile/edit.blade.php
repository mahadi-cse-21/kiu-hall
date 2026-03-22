<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 "></div>
            <div class="relative px-4 sm:px-0">
                <a href="{{ route(Auth::user()->role.'.dashboard') }}" class="group flex items-center space-x-2 text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 ">
                    
                        <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl  leading-tight group-hover:from-indigo-700 group-hover:via-purple-700 group-hover:to-pink-700 transition-all duration-300">
                            Dashboard
                        </h2>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-indigo-500 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
             </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gradient-to-br from-gray-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">
            
            <!-- Profile Information Card -->
            <div class="group relative bg-white shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl sm:rounded-2xl overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Profile Information</h3>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Update your account's profile information and email address</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10">
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4 sm:space-y-6">
                            @csrf
                            @method('patch')

                            <div class="group/input">
                                <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-semibold text-sm" />
                                <div class="relative mt-2">
                                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 group-focus-within/input:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="name" name="name" type="text" class="pl-10 sm:pl-12 block w-full border-2 border-indigo-500 rounded-lg sm:rounded-xl py-3  shadow-sm   transition-all duration-200 text-sm sm:text-base" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                </div>
                                <x-input-error class="mt-2 text-xs sm:text-sm" :messages="$errors->get('name')" />
                            </div>

                            <div class="group/input">
                                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold text-sm" />
                                <div class="relative mt-2">
                                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 group-focus-within/input:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <x-text-input id="email" name="email" type="email" class="pl-10 sm:pl-12 block w-full border-2 border-indigo-500 rounded-lg sm:rounded-xl py-3  shadow-sm   transition-all duration-200 text-sm sm:text-base" :value="old('email', $user->email)" required autocomplete="username" />
                                </div>
                                <x-input-error class="mt-2 text-xs sm:text-sm" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-3 p-3 sm:p-4 bg-amber-50 border-l-4 border-amber-400 rounded-lg">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-xs sm:text-sm text-amber-800">
                                                    {{ __('Your email address is unverified.') }}
                                                    <button form="send-verification" class="font-medium underline hover:text-amber-900 transition-colors">
                                                        {{ __('Click here to re-send the verification email.') }}
                                                    </button>
                                                </p>
                                            </div>
                                        </div>

                                        @if (session('status') === 'verification-link-sent')
                                            <div class="mt-3 flex items-center">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <p class="text-xs sm:text-sm font-medium text-green-700">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-2 sm:pt-4">
                                <x-primary-button class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-lg sm:rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 text-sm sm:text-base">
                                    {{ __('Save Changes') }}
                                </x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <div
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="flex items-center justify-center sm:justify-start text-xs sm:text-sm font-medium text-green-600"
                                    >
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('Saved successfully!') }}
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="group relative bg-white shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl sm:rounded-2xl overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Update Password</h3>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Ensure your account uses a strong password to stay secure</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="group relative bg-white shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl sm:rounded-2xl overflow-hidden border-2 border-transparent hover:border-red-200">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 via-red-500 to-red-600"></div>
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-red-50 to-orange-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg transform group-hover:rotate-12 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Delete Account</h3>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Permanently delete your account and all associated data</p>
                        </div>
                    </div>
                    
                    <div class="relative z-10">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Helpful Tips Card -->
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-xl rounded-xl sm:rounded-2xl overflow-hidden">
                <div class="p-4 sm:p-6 lg:p-8 text-white">
                    <div class="flex flex-col sm:flex-row items-start space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base sm:text-lg font-bold mb-2">Security Tips</h4>
                            <ul class="space-y-2 text-xs sm:text-sm text-indigo-100">
                                <li class="flex items-start">
                                    <span class="mr-2 flex-shrink-0">•</span>
                                    <span>Use a unique password that you don't use for other accounts</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2 flex-shrink-0">•</span>
                                    <span>Enable two-factor authentication for added security</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="mr-2 flex-shrink-0">•</span>
                                    <span>Keep your email address up to date for account recovery</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>