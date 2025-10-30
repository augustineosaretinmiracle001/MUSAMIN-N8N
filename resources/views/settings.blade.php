<x-app-layout>
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <button onclick="toggleMobileMenu()" class="lg:hidden mr-4 p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                <p class="text-gray-600 mt-1">Manage your preferences and n8n integration</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Settings Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <nav class="space-y-2">
                    <a href="#preferences" onclick="showTab('preferences')" class="settings-tab active flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        User Preferences
                    </a>
                    <a href="#api" onclick="showTab('api')" class="settings-tab flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        API Configuration
                    </a>
                    <a href="#account" onclick="showTab('account')" class="settings-tab flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Account Settings
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-2">
            <!-- User Preferences Tab -->
            <div id="preferences-tab" class="settings-content">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Script Generation Preferences</h3>
                    
                    <form action="{{ route('settings.preferences') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Content Niche</label>
                            <select name="niche" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="general" {{ (auth()->user()->preferences->niche ?? 'general') === 'general' ? 'selected' : '' }}>General</option>
                                <option value="philosophy" {{ (auth()->user()->preferences->niche ?? '') === 'philosophy' ? 'selected' : '' }}>Philosophy</option>
                                <option value="technology" {{ (auth()->user()->preferences->niche ?? '') === 'technology' ? 'selected' : '' }}>Technology</option>
                                <option value="business" {{ (auth()->user()->preferences->niche ?? '') === 'business' ? 'selected' : '' }}>Business</option>
                                <option value="lifestyle" {{ (auth()->user()->preferences->niche ?? '') === 'lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                <option value="education" {{ (auth()->user()->preferences->niche ?? '') === 'education' ? 'selected' : '' }}>Education</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tone</label>
                            <select name="tone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="neutral" {{ (auth()->user()->preferences->tone ?? 'neutral') === 'neutral' ? 'selected' : '' }}>Neutral</option>
                                <option value="emotional" {{ (auth()->user()->preferences->tone ?? '') === 'emotional' ? 'selected' : '' }}>Emotional</option>
                                <option value="professional" {{ (auth()->user()->preferences->tone ?? '') === 'professional' ? 'selected' : '' }}>Professional</option>
                                <option value="casual" {{ (auth()->user()->preferences->tone ?? '') === 'casual' ? 'selected' : '' }}>Casual</option>
                                <option value="humorous" {{ (auth()->user()->preferences->tone ?? '') === 'humorous' ? 'selected' : '' }}>Humorous</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Writing Style</label>
                            <select name="style" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="standard" {{ (auth()->user()->preferences->style ?? 'standard') === 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="philosophical" {{ (auth()->user()->preferences->style ?? '') === 'philosophical' ? 'selected' : '' }}>Philosophical</option>
                                <option value="storytelling" {{ (auth()->user()->preferences->style ?? '') === 'storytelling' ? 'selected' : '' }}>Storytelling</option>
                                <option value="direct" {{ (auth()->user()->preferences->style ?? '') === 'direct' ? 'selected' : '' }}>Direct</option>
                                <option value="conversational" {{ (auth()->user()->preferences->style ?? '') === 'conversational' ? 'selected' : '' }}>Conversational</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Target Audience</label>
                            <input type="text" name="target_audience" value="{{ auth()->user()->preferences->target_audience ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g., Young professionals, Students, Entrepreneurs">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Custom Instructions</label>
                            <textarea name="custom_instructions" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Any specific instructions for script generation...">{{ auth()->user()->preferences->custom_instructions ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                            Save Preferences
                        </button>
                    </form>
                </div>
            </div>

            <!-- API Configuration Tab -->
            <div id="api-tab" class="settings-content hidden">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">API Configuration</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your User UUID</label>
                            <div class="flex items-center space-x-2">
                                <input type="text" value="{{ auth()->user()->id }}" readonly 
                                       class="flex-1 px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600">
                                <button onclick="copyToClipboard('{{ auth()->user()->id }}')" 
                                        class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                    Copy
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Use this UUID in your n8n workflows</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">API Endpoints</label>
                            <div class="space-y-3">
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <code class="text-sm text-gray-800">GET {{ url('/api/users/' . auth()->user()->id . '/preferences') }}</code>
                                    <p class="text-xs text-gray-600 mt-1">Get your script generation preferences</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <code class="text-sm text-gray-800">POST {{ url('/api/users/' . auth()->user()->id . '/scripts') }}</code>
                                    <p class="text-xs text-gray-600 mt-1">Save generated scripts to your account</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <code class="text-sm text-gray-800">POST {{ url('/api/trigger-generation') }}</code>
                                    <p class="text-xs text-gray-600 mt-1">Trigger script generation workflow</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">API Token</label>
                            <div class="flex items-center space-x-2">
                                <input type="password" id="apiToken" value="••••••••••••••••••••" readonly 
                                       class="flex-1 px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600">
                                <button onclick="generateToken()" 
                                        class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                    Generate New
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Use this token for API authentication</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Settings Tab -->
            <div id="account-tab" class="settings-content hidden">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Account Settings</h3>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                            Update Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all content
            document.querySelectorAll('.settings-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.settings-tab').forEach(tab => {
                tab.classList.remove('active', 'bg-indigo-100', 'text-indigo-600');
                tab.classList.add('text-gray-600', 'hover:bg-gray-100');
            });
            
            // Show selected content
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            
            // Add active class to selected tab
            event.target.classList.add('active', 'bg-indigo-100', 'text-indigo-600');
            event.target.classList.remove('text-gray-600', 'hover:bg-gray-100');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = originalText;
                }, 2000);
            });
        }

        function generateToken() {
            fetch('/api/generate-token', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('apiToken').type = 'text';
                document.getElementById('apiToken').value = data.token;
                setTimeout(() => {
                    document.getElementById('apiToken').type = 'password';
                    document.getElementById('apiToken').value = '••••••••••••••••••••';
                }, 10000);
            });
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.settings-tab').classList.add('active', 'bg-indigo-100', 'text-indigo-600');
            document.querySelector('.settings-tab').classList.remove('text-gray-600', 'hover:bg-gray-100');
        });
    </script>

    <style>
        .settings-tab {
            @apply text-gray-600 hover:bg-gray-100;
        }
        .settings-tab.active {
            @apply bg-indigo-100 text-indigo-600;
        }
    </style>
</x-app-layout>