<!-- Logo -->
<div class="flex items-center justify-center h-16 bg-indigo-600">
    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
        <span class="text-indigo-600 font-bold text-sm">N8</span>
    </div>
</div>

<!-- Navigation -->
<nav class="flex-1 px-2 py-4 space-y-2">
    <div class="relative group">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center justify-center w-12 h-12 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-600' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            </svg>
        </a>
        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
            Dashboard
        </div>
    </div>

    <div class="relative group">
        <a href="#" 
           class="flex items-center justify-center w-12 h-12 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
        </a>
        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
            Workflows
        </div>
    </div>

    <div class="relative group">
        <a href="{{ route('scripts') }}" 
           class="flex items-center justify-center w-12 h-12 rounded-lg transition-colors {{ request()->routeIs('scripts') ? 'bg-indigo-100 text-indigo-600' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
            </svg>
        </a>
        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
            Scripts
        </div>
    </div>

    <div class="relative group">
        <a href="#" 
           class="flex items-center justify-center w-12 h-12 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </a>
        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
            Executions
        </div>
    </div>

    <div class="relative group">
        <a href="{{ route('settings') }}" 
           class="flex items-center justify-center w-12 h-12 rounded-lg transition-colors {{ request()->routeIs('settings') ? 'bg-indigo-100 text-indigo-600' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>
        <div class="absolute left-16 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
            Settings
        </div>
    </div>
</nav>

<!-- User Menu -->
<div class="px-2 py-4 border-t border-gray-200">
    <div class="flex flex-col items-center space-y-2">
        <div class="relative group">
            <a href="{{ route('profile.edit') }}" class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center hover:bg-indigo-700 transition-colors">
                <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </a>
            <div class="absolute left-12 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
                {{ Auth::user()->name }}
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="relative group">
                <button type="submit" class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
                <div class="absolute left-10 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-50">
                    Logout
                </div>
            </div>
        </form>
    </div>
</div>