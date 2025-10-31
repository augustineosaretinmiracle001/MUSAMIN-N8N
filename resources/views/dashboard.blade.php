<x-app-layout>
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden mr-4 p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
        </div>
        <div class="flex space-x-2 sm:space-x-3">
            <button onclick="generateScript()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 sm:px-4 rounded-lg flex items-center transition-colors" title="Generate Script">
                <svg class="w-4 h-4 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="hidden sm:inline">Generate Script</span>
            </button>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 sm:px-4 rounded-lg flex items-center transition-colors" title="New Workflow">
                <svg class="w-4 h-4 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="hidden sm:inline">New Workflow</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Workflows</p>
                    <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->workflows()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Workflows</p>
                    <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->workflows()->where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Scripts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->scripts()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Executions Today</p>
                    <p class="text-2xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Recent Scripts</h3>
                <span class="text-sm text-gray-500">{{ Auth::user()->scripts()->count() }} total</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            @if(Auth::user()->scripts()->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niche</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(Auth::user()->scripts()->latest()->take(10)->get() as $script)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div class="h-8 w-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $script->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($script->content, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($script->niche) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $script->status === 'generated' ? 'bg-green-100 text-green-800' : ($script->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($script->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $script->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="viewScript('{{ $script->id }}')" class="text-indigo-600 hover:text-indigo-900 mr-3">View</button>
                                    <button onclick="copyScript('{{ $script->content }}')" class="text-gray-600 hover:text-gray-900 mr-3">Copy</button>
                                    <button onclick="deleteScript('{{ $script->id }}')" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No scripts yet</h3>
                    <p class="text-gray-500 mb-4">Scripts generated by n8n will appear here</p>
                    <div class="text-sm text-gray-400">
                        <p>Connect your n8n instance to start generating scripts</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script View Modal -->
    <div id="scriptModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 overflow-y-auto max-h-[70vh]">
                    <div id="modalContent" class="prose max-w-none"></div>
                </div>
                <div class="flex items-center justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button onclick="copyModalContent()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Copy Content
                    </button>
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Generation Modal -->
    <div id="generateModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Generate New Script</h3>
                    <button onclick="closeGenerateModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <form id="generateForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Script Type</label>
                            <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="youtube_script">YouTube Script</option>
                                <option value="blog_post">Blog Post</option>
                                <option value="social_media">Social Media Content</option>
                                <option value="email_newsletter">Email Newsletter</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Topic (Optional)</label>
                            <input type="text" name="topic" placeholder="Enter a specific topic..." 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Additional Instructions</label>
                            <textarea name="instructions" rows="3" placeholder="Any specific requirements..." 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-end space-x-3 p-6 border-t bg-gray-50">
                    <button onclick="closeGenerateModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Cancel
                    </button>
                    <button onclick="triggerGeneration()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <span id="generateBtnText">Generate Script</span>
                        <svg id="generateSpinner" class="hidden animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentScriptContent = '';
        
        function viewScript(scriptId) {
            fetch(`/api/scripts/${scriptId}`, {
                headers: {
                    'Authorization': 'Bearer ' + '{{ auth()->user()->createToken("dashboard")->plainTextToken }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(script => {
                document.getElementById('modalTitle').textContent = script.title;
                document.getElementById('modalContent').innerHTML = `
                    <div class="mb-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full mb-2">
                            ${script.niche}
                        </span>
                    </div>
                    <div class="whitespace-pre-wrap">${script.content}</div>
                `;
                currentScriptContent = script.content;
                document.getElementById('scriptModal').classList.remove('hidden');
            })
            .catch(error => {
                alert('Error loading script');
                console.error(error);
            });
        }
        
        function copyScript(content) {
            navigator.clipboard.writeText(content).then(() => {
                // Show success message
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.classList.add('text-green-600');
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('text-green-600');
                }, 2000);
            });
        }
        
        function copyModalContent() {
            navigator.clipboard.writeText(currentScriptContent).then(() => {
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = originalText;
                }, 2000);
            });
        }
        
        function deleteScript(scriptId) {
            if (confirm('Are you sure you want to delete this script?')) {
                fetch(`/api/scripts/${scriptId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + '{{ auth()->user()->createToken("dashboard")->plainTextToken }}',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Error deleting script');
                    }
                });
            }
        }
        
        function closeModal() {
            document.getElementById('scriptModal').classList.add('hidden');
        }
        
        function generateScript() {
            document.getElementById('generateModal').classList.remove('hidden');
        }
        
        function closeGenerateModal() {
            document.getElementById('generateModal').classList.add('hidden');
            document.getElementById('generateForm').reset();
        }
        
        function triggerGeneration() {
            const form = document.getElementById('generateForm');
            const formData = new FormData(form);
            const data = {
                user_uuid: '{{ auth()->user()->id }}',
                type: formData.get('type'),
                parameters: {
                    topic: formData.get('topic'),
                    instructions: formData.get('instructions')
                }
            };
            
            // Show loading state
            const btnText = document.getElementById('generateBtnText');
            const spinner = document.getElementById('generateSpinner');
            btnText.textContent = 'Generating...';
            spinner.classList.remove('hidden');
            
            fetch('https://n8n.musamin.app/webhook/trigger-generation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_uuid: data.user_uuid,
                    type: data.type,
                    topic: data.parameters.topic,
                    instructions: data.parameters.instructions,
                    triggered_at: new Date().toISOString()
                })
            })
            .then(response => response.json())
            .then(result => {
                console.log('Script generation triggered:', result);
                closeGenerateModal();
                showNotification('Script generation started! Check back in a few minutes.', 'success');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error connecting to n8n. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                btnText.textContent = 'Generate Script';
                spinner.classList.add('hidden');
            });
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${
                type === 'success' ? 'bg-green-600' : 'bg-red-600'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
        
        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeGenerateModal();
            }
        });
    </script>
</x-app-layout>