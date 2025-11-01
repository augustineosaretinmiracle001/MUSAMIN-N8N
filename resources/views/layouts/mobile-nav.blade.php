<!-- Mobile Navigation - Only visible on mobile -->
<div class="lg:hidden fixed top-0 left-0 right-0 bg-gray-50 z-40">
    <div class="flex items-center justify-between px-4 py-3">
        <!-- Hamburger Menu Button -->
        <button onclick="toggleMobileMenu()" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <!-- Logo/Title -->
        <div class="flex items-center">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2">
                <span class="text-white font-bold text-sm">N8</span>
            </div>
            <span class="text-lg font-semibold text-gray-900">Musamin</span>
        </div>
        
        <!-- User Avatar -->
        <a href="{{ route('profile.edit') }}" class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center hover:bg-indigo-700 transition-colors">
            <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </a>
    </div>
</div>

<!-- Mobile Content Spacer -->
<div class="lg:hidden h-16"></div>