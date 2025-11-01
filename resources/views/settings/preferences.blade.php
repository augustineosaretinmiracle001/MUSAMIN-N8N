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
                <label class="block text-sm font-medium text-gray-700 mb-2">Content Niche</label>
                <input type="text" name="content_niche" value="{{ auth()->user()->preferences->content_niche ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Storytelling, Education, Technology, Business">
                <p class="text-sm text-gray-500 mt-1">What type of content do you primarily create?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Writing Tone</label>
                <input type="text" name="writing_tone" value="{{ auth()->user()->preferences->writing_tone ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Professional, Casual, Humorous, Friendly">
                <p class="text-sm text-gray-500 mt-1">What tone should your scripts have?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Writing Style</label>
                <input type="text" name="writing_style" value="{{ auth()->user()->preferences->writing_style ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Conversational, Direct, Storytelling, Educational">
                <p class="text-sm text-gray-500 mt-1">How should your content be structured and presented?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Target Audience</label>
                <input type="text" name="target_audience" value="{{ auth()->user()->preferences->target_audience ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Young professionals, Students, Entrepreneurs, General audience">
                <p class="text-sm text-gray-500 mt-1">Who is your primary audience?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Custom Instructions</label>
                <textarea name="custom_instructions" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Any specific instructions for script generation...">{{ auth()->user()->preferences->custom_instructions ?? '' }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Additional guidelines for AI to follow when generating your scripts</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    Save Preferences
                </button>
            </div>
        </form>
    </div>
</x-app-layout>