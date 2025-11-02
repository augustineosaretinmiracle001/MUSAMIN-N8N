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
        <p class="text-gray-600">Configure your script generation preferences and schedules</p>
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
                <input type="text" name="niche" value="{{ auth()->user()->preferences?->getNiche() ?? '' }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="e.g., Storytelling, Education, Technology, Business">
                <p class="text-sm text-gray-500 mt-1">What type of content do you primarily create?</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Instructions</label>
                <textarea name="instructions" rows="6" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="e.g., Target young professionals, use casual tone, conversational style, be relatable, ask engaging questions, keep it under 2 minutes...">{{ auth()->user()->preferences?->getInstructions() ?? '' }}</textarea>
                <p class="text-sm text-gray-500 mt-1">All your preferences: target audience, tone, style, length, format, etc.</p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700">Auto Generate Title</label>
                    <input type="checkbox" name="auto_generate_title" value="1" 
                           {{ (auth()->user()->preferences?->getAutoGenerateTitle() ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                           onchange="toggleTitleField(this)">
                </div>
                <p class="text-sm text-gray-500 mb-3">Let AI create unique titles for each script</p>
                
                <div id="titleField" class="{{ (auth()->user()->preferences?->getAutoGenerateTitle() ?? true) ? 'hidden' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Title</label>
                    <input type="text" name="title" value="{{ auth()->user()->preferences?->getTitle() ?? '' }}" 
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

        <hr class="my-8">

        <!-- Schedules Section -->
        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Automated Schedules</h4>
            
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-gray-600">Set up automated script generation</p>
                <button type="button" onclick="showCreateScheduleForm()" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">
                    Create Schedule
                </button>
            </div>
            
            <!-- Create Schedule Form -->
            <div id="createScheduleForm" class="hidden bg-gray-50 p-4 rounded-lg mb-4">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Schedule Name</label>
                        <input type="text" id="scheduleName" required placeholder="e.g., Daily Morning Scripts" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Frequency Type</label>
                            <input type="text" id="frequencyType" required placeholder="e.g., minutes, hours, days, weeks, months" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Frequency Value</label>
                            <input type="number" id="frequencyValue" value="1" min="1" required placeholder="e.g., 1, 2, 5, 10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button type="button" onclick="createSchedule()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Create Schedule
                        </button>
                        <button type="button" onclick="hideCreateScheduleForm()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </div>
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

    <script>
        function toggleTitleField(checkbox) {
            const titleField = document.getElementById('titleField');
            if (checkbox.checked) {
                titleField.classList.add('hidden');
            } else {
                titleField.classList.remove('hidden');
            }
        }

        // Schedule functions
        function showCreateScheduleForm() {
            document.getElementById('createScheduleForm').classList.remove('hidden');
        }
        
        function hideCreateScheduleForm() {
            document.getElementById('createScheduleForm').classList.add('hidden');
            document.getElementById('scheduleName').value = '';
            document.getElementById('frequencyValue').value = '1';
            document.getElementById('frequencyType').value = '';
        }
        
        function createSchedule() {
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
    </script>
</x-app-layout>