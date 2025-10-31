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

        <!-- Assets -->
        @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    </head>
    <body>
        <div class="dashboard-layout">
            <!-- Mobile Overlay -->
            <div id="mobile-overlay" class="modal-overlay" style="display: none;"></div>
            
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
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