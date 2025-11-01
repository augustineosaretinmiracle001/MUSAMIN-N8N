<x-app-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600 mt-1">Manage your preferences and n8n integration</p>
    </div>

    <div class="flex flex-col lg:grid lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Settings Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
                <nav class="flex lg:flex-col space-x-2 lg:space-x-0 lg:space-y-2 overflow-x-auto lg:overflow-x-visible">
                    <a href="#preferences" onclick="showTab('preferences')" class="settings-tab active flex items-center px-3 py-2 text-sm font-medium rounded-lg whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="hidden sm:inline">User Preferences</span>
                        <span class="sm:hidden">Preferences</span>
                    </a>
                    <a href="#api" onclick="showTab('api')" class="settings-tab flex items-center px-3 py-2 text-sm font-medium rounded-lg whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <span class="hidden sm:inline">API Configuration</span>
                        <span class="sm:hidden">API</span>
                    </a>
                    <a href="#schedules" onclick="showTab('schedules')" class="settings-tab flex items-center px-3 py-2 text-sm font-medium rounded-lg whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="hidden sm:inline">Schedules</span>
                        <span class="sm:hidden">Schedules</span>
                    </a>
                    <a href="#account" onclick="showTab('account')" class="settings-tab flex items-center px-3 py-2 text-sm font-medium rounded-lg whitespace-nowrap">
                        <svg class="w-5 h-5 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="hidden sm:inline">Account Settings</span>
                        <span class="sm:hidden">Account</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-2 min-w-0">
            <!-- User Preferences Tab -->
            <div id="preferences-tab" class="settings-content">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">API Configuration</h3>
                    
                    <div class="space-y-6">
                        <!-- Create New Token -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-md font-medium text-gray-900">API Tokens</h4>
                                <button onclick="showCreateTokenForm()" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                                    Create New Token
                                </button>
                            </div>
                            
                            <!-- Create Token Form -->
                            <div id="createTokenForm" class="hidden bg-gray-50 p-4 rounded-lg mb-4">
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Token Name</label>
                                        <input type="text" id="tokenName" placeholder="e.g., Mobile App, Third-party Integration" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="flex space-x-2">
                                        <button onclick="createToken()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Create Token
                                        </button>
                                        <button onclick="hideCreateTokenForm()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tokens List -->
                            <div id="tokensList" class="space-y-3">
                                @forelse(auth()->user()->tokens as $token)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-medium text-gray-900">{{ $token->name }}</h5>
                                                <p class="text-sm text-gray-500">Created {{ $token->created_at->diffForHumans() }}</p>
                                                <p class="text-sm text-gray-500">Last used {{ $token->last_used_at ? $token->last_used_at->diffForHumans() : 'Never' }}</p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button onclick="deleteToken('{{ $token->id }}')" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-sm">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        <p>No API tokens created yet</p>
                                        <p class="text-sm">Create your first token to get started</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- New Token Display Modal -->
                        <div id="newTokenModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div class="bg-white rounded-lg max-w-md w-full p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">New API Token Created</h3>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Token (copy now - won't be shown again)</label>
                                        <div class="flex items-center space-x-2">
                                            <input type="text" id="newTokenValue" readonly 
                                                   class="flex-1 px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm font-mono">
                                            <button onclick="copyNewToken()" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                    <button onclick="closeNewTokenModal()" class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedules Tab -->
            <div id="schedules-tab" class="settings-content hidden">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Automated Script Generation</h3>
                    
                    <div class="space-y-6">
                        <!-- Create New Schedule -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-md font-medium text-gray-900">Schedules</h4>
                                <button onclick="showCreateScheduleForm()" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                                    Create Schedule
                                </button>
                            </div>
                            
                            <!-- Create Schedule Form -->
                            <div id="createScheduleForm" class="hidden bg-gray-50 p-4 rounded-lg mb-4">
                                <form onsubmit="createSchedule(event)" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Schedule Name</label>
                                            <input type="text" id="scheduleName" required placeholder="e.g., Daily Morning Scripts" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Frequency</label>
                                            <select id="frequencyType" onchange="updateFrequencyInputs()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="minutes">Minutes</option>
                                                <option value="hours">Hours</option>
                                                <option value="days" selected>Days</option>
                                                <option value="weeks">Weeks</option>
                                                <option value="months">Months</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Every</label>
                                        <div class="flex items-center space-x-2">
                                            <input type="number" id="frequencyValue" value="1" min="1" required
                                                   class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            <span id="frequencyLabel" class="text-sm text-gray-600">day(s)</span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                            Create Schedule
                                        </button>
                                        <button type="button" onclick="hideCreateScheduleForm()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Schedules List -->
                            <div id="schedulesList" class="space-y-3">
                                @forelse(auth()->user()->schedules ?? [] as $schedule)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-medium text-gray-900">{{ $schedule->name }}</h5>
                                                <p class="text-sm text-gray-500">Every {{ $schedule->frequency_value }} {{ $schedule->frequency_type }}</p>
                                                <p class="text-sm text-gray-500">Next run: {{ $schedule->next_run_at ? $schedule->next_run_at->format('M j, Y g:i A') : 'Not scheduled' }}</p>
                                                <p class="text-sm text-gray-500">Status: 
                                                    <span class="{{ $schedule->is_active ? 'text-green-600' : 'text-red-600' }}">
                                                        {{ $schedule->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button onclick="toggleSchedule('{{ $schedule->id }}', {{ $schedule->is_active ? 'false' : 'true' }})" 
                                                        class="px-3 py-1 {{ $schedule->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} rounded text-sm">
                                                    {{ $schedule->is_active ? 'Pause' : 'Activate' }}
                                                </button>
                                                <button onclick="deleteSchedule('{{ $schedule->id }}')" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-sm">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p>No schedules created yet</p>
                                        <p class="text-sm">Create your first schedule to automate script generation</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Settings Tab -->
            <div id="account-tab" class="settings-content hidden">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Account Information</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly
                                   class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" readonly
                                   class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                        </div>

                        <div class="pt-4">
                            <p class="text-sm text-gray-600 mb-4">To update your account information, please visit your profile page.</p>
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Profile
                            </a>
                        </div>
                    </div>
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



        function showCreateTokenForm() {
            document.getElementById('createTokenForm').classList.remove('hidden');
        }
        
        function hideCreateTokenForm() {
            document.getElementById('createTokenForm').classList.add('hidden');
            document.getElementById('tokenName').value = '';
        }
        
        function createToken() {
            const name = document.getElementById('tokenName').value.trim();
            if (!name) {
                alert('Please enter a token name');
                return;
            }
            
            fetch('/api/generate-token', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({ name: name })
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    document.getElementById('newTokenValue').value = data.token;
                    document.getElementById('newTokenModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    hideCreateTokenForm();
                    // Refresh the page to show new token in list
                    setTimeout(() => location.reload(), 2000);
                } else {
                    alert('Error creating token');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating token');
            });
        }
        
        function copyNewToken() {
            const tokenInput = document.getElementById('newTokenValue');
            tokenInput.select();
            document.execCommand('copy');
            
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.add('bg-green-600');
            button.classList.remove('bg-indigo-600');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-indigo-600');
            }, 2000);
        }
        
        function closeNewTokenModal() {
            document.getElementById('newTokenModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function deleteToken(tokenId) {
            if (!confirm('Are you sure you want to delete this token? This action cannot be undone.')) {
                return;
            }
            
            fetch(`/api/tokens/${tokenId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Error deleting token');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting token');
            });
        }

        // Schedule Management Functions
        function showCreateScheduleForm() {
            document.getElementById('createScheduleForm').classList.remove('hidden');
        }
        
        function hideCreateScheduleForm() {
            document.getElementById('createScheduleForm').classList.add('hidden');
            document.getElementById('scheduleName').value = '';
            document.getElementById('frequencyValue').value = '1';
            document.getElementById('frequencyType').value = 'days';
            updateFrequencyInputs();
        }
        
        function updateFrequencyInputs() {
            const type = document.getElementById('frequencyType').value;
            const label = document.getElementById('frequencyLabel');
            const value = document.getElementById('frequencyValue');
            
            switch(type) {
                case 'minutes':
                    label.textContent = 'minute(s)';
                    value.min = '1';
                    value.max = '59';
                    break;
                case 'hours':
                    label.textContent = 'hour(s)';
                    value.min = '1';
                    value.max = '23';
                    break;
                case 'days':
                    label.textContent = 'day(s)';
                    value.min = '1';
                    value.max = '365';
                    break;
                case 'weeks':
                    label.textContent = 'week(s)';
                    value.min = '1';
                    value.max = '52';
                    break;
                case 'months':
                    label.textContent = 'month(s)';
                    value.min = '1';
                    value.max = '12';
                    break;
            }
        }
        
        function createSchedule(event) {
            event.preventDefault();
            
            const name = document.getElementById('scheduleName').value.trim();
            const frequencyType = document.getElementById('frequencyType').value;
            const frequencyValue = document.getElementById('frequencyValue').value;
            
            if (!name) {
                alert('Please enter a schedule name');
                return;
            }
            
            fetch('/api/schedules', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    name: name,
                    frequency_type: frequencyType,
                    frequency_value: parseInt(frequencyValue)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    hideCreateScheduleForm();
                    location.reload();
                } else {
                    alert(data.message || 'Error creating schedule');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating schedule');
            });
        }
        
        function toggleSchedule(scheduleId, isActive) {
            fetch(`/api/schedules/${scheduleId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    is_active: isActive
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Error updating schedule');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating schedule');
            });
        }
        
        function deleteSchedule(scheduleId) {
            if (!confirm('Are you sure you want to delete this schedule? This action cannot be undone.')) {
                return;
            }
            
            fetch(`/api/schedules/${scheduleId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Error deleting schedule');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting schedule');
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