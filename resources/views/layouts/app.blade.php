<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Figtree', 'sans-serif'],
                        },
                    },
                },
            }
        </script>
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="flex h-screen">
            <!-- Mobile Overlay -->
            <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
            
            <!-- Sidebar -->
            <div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-16 bg-white shadow-lg flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-y-auto p-4 lg:p-8">
                {{ $slot }}
            </div>
        </div>

        <script>
            // Mobile menu toggle
            function toggleMobileMenu() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('mobile-overlay');
                
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            // Setup event listeners
            document.addEventListener('DOMContentLoaded', function() {
                const overlay = document.getElementById('mobile-overlay');
                const sidebar = document.getElementById('sidebar');
                
                // Overlay click closes sidebar
                overlay.addEventListener('click', toggleMobileMenu);

                // Close sidebar when clicking on a link (mobile)
                const sidebarLinks = sidebar.querySelectorAll('a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth < 1024) {
                            toggleMobileMenu();
                        }
                    });
                });
            });

            // Make toggle function globally available
            window.toggleMobileMenu = toggleMobileMenu;
        </script>
    </body>
</html>