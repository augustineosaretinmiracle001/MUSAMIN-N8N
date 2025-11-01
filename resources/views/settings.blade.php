<x-app-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600 mt-1">Manage your preferences and configuration</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- User Preferences -->
        <a href="{{ route('settings.preferences') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">User Preferences</h3>
            </div>
            <p class="text-gray-600 text-sm">Configure your script generation preferences and default settings</p>
        </a>

        <!-- API Configuration -->
        <a href="{{ route('settings.api') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">API Configuration</h3>
            </div>
            <p class="text-gray-600 text-sm">Manage your API tokens and integration settings</p>
        </a>

        <!-- Schedules -->
        <a href="{{ route('settings.schedules') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Schedules</h3>
            </div>
            <p class="text-gray-600 text-sm">Set up automated script generation schedules</p>
        </a>

        <!-- Account Settings -->
        <a href="{{ route('settings.account') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Account Settings</h3>
            </div>
            <p class="text-gray-600 text-sm">Update your account information and profile</p>
        </a>
    </div>
</x-app-layout>