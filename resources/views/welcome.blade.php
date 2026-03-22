<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hall Meal Management System</title>
    <link rel="shortcut icon" href="image.png" type="image/x-icon">
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://cdn.tailwindcss.com" as="style">
    
    <!-- Load CSS efficiently -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Inline critical CSS -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 50%, #faf5ff 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Simplified background elements */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            opacity: 0.4;
            filter: blur(40px);
            z-index: -1;
        }
        
        /* Ensure content is visible immediately */
        .main-content {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        /* Loading state */
        .loading {
            opacity: 0;
        }
        
        .loaded {
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Simplified Background Shapes -->
    <div class="bg-shape" style="top: -100px; right: -100px; width: 300px; height: 300px; background: #bfdbfe;"></div>
    <div class="bg-shape" style="bottom: -100px; left: -100px; width: 300px; height: 300px; background: #c7d2fe;"></div>

    <div class="main-content loading relative flex items-center justify-center min-h-screen p-4">
        <!-- Main Card -->
        <div class="glass-effect border border-white/20 rounded-3xl shadow-xl w-full max-w-md overflow-hidden">
            <!-- Header Section with Gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center">
                <div class="flex items-center justify-center gap-3 mb-3">
                    <div class="p-2 bg-white/20 rounded-xl">
                        <!-- Simplified SVG -->
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2 M7 2v20 M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3v7"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Hall Meal System</h1>
                <p class="text-blue-100 text-sm">Manage your meals with ease</p>
            </div>

            <!-- Action Buttons -->
            <div class="p-6 space-y-4">
                <!-- Login Button -->
                <a href="{{ route('login') }}" 
                   class="block w-full px-4 py-3 text-base font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:border-blue-400 hover:shadow-md transition-all duration-200 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Log in to Account
                    </div>
                </a>

                <!-- Register Button -->
                <a href="{{ route('register') }}" 
                   class="block w-full px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl hover:from-blue-700 hover:to-indigo-800 shadow-md hover:shadow-lg transition-all duration-200 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Create New Account
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Mark as loaded when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.querySelector('.main-content');
            if (mainContent) {
                mainContent.classList.remove('loading');
                mainContent.classList.add('loaded');
            }
            
            // Preload next pages if needed
            const links = document.querySelectorAll('a[href*="{{ route"]');
            links.forEach(link => {
                // Add preload logic if needed
                link.addEventListener('mouseenter', function() {
                    // Optional: preload hints
                });
            });
        });
        
        // Fallback if resources fail to load
        window.addEventListener('load', function() {
            const mainContent = document.querySelector('.main-content');
            if (mainContent) {
                mainContent.classList.remove('loading');
                mainContent.classList.add('loaded');
            }
        });
        
        // Ensure content shows even if some resources fail
        setTimeout(function() {
            const mainContent = document.querySelector('.main-content');
            if (mainContent && mainContent.classList.contains('loading')) {
                mainContent.classList.remove('loading');
                mainContent.classList.add('loaded');
            }
        }, 1000);
    </script>
</body>
</html>