<x-app-layout>
    <div class="mb-6">
        <div class="flex items-center mb-4">
            <a href="{{ route('settings') }}" class="text-gray-500 hover:text-gray-700 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">User Preferences</h1>
        </div>
        <p class="text-gray-600">Configure your default script generation preferences</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.preferences.update') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Niche</label>
                <input type="text" name="niche" value="{{ auth()->user()->preferences->getNiche() ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Storytelling, Education, Technology, Business">
                <p class="text-sm text-gray-500 mt-1">What type of content do you primarily create?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Instructions</label>
                <textarea name="instructions" rows="6" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="e.g., Target young professionals, use casual tone, conversational style, be relatable, ask engaging questions, keep it under 2 minutes...">{{ auth()->user()->preferences->getInstructions() ?? '' }}</textarea>
                <p class="text-sm text-gray-500 mt-1">All your preferences: target audience, tone, style, length, format, etc.</p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Auto Generate Title</label>
                    <input type="checkbox" name="auto_generate_title" value="1" 
                           {{ (auth()->user()->preferences->getAutoGenerateTitle() ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                           onchange="toggleTitleField(this)">
                </div>
                <p class="text-sm text-gray-500 mb-3">Let AI create unique titles for each script</p>
                
                <div id="titleField" class="{{ (auth()->user()->preferences->getAutoGenerateTitle() ?? true) ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Title</label>
                    <input type="text" name="title" value="{{ auth()->user()->preferences->getTitle() ?? '' }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="e.g., Daily Stories with John">
                    <p class="text-sm text-gray-500 mt-1">This title will be used when auto generation is off</p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    Save Preferences
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleTitleField(checkbox) {
            const titleField = document.getElementById('titleField');
            if (checkbox.checked) {
                titleField.classList.add('hidden');
            } else {
                titleField.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>