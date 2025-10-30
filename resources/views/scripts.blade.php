<x-app-layout>
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <button onclick="toggleMobileMenu()" class="lg:hidden mr-4 p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Scripts</h1>
                <p class="text-gray-600 mt-1">Manage all your generated scripts</p>
            </div>
        </div>
        
        <button onclick="generateScript()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            Generate New Script
        </button>
    </div>

    <!-- Filter and Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search scripts..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                
                <select id="nicheFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Niches</option>
                    <option value="general">General</option>
                    <option value="philosophy">Philosophy</option>
                    <option value="technology">Technology</option>
                    <option value="business">Business</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="education">Education</option>
                </select>
                
                <select id="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="generated">Generated</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">{{ Auth::user()->scripts()->count() }} total scripts</span>
            </div>
        </div>
    </div>

    <!-- Scripts Grid -->
    <div id="scriptsContainer">
        @if(Auth::user()->scripts()->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(Auth::user()->scripts()->latest()->get() as $script)
                    <div class="script-card bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow" 
                         data-niche="{{ $script->niche }}" data-status="{{ $script->status }}" data-title="{{ strtolower($script->title) }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($script->niche) }}
                                </span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $script->status === 'generated' ? 'bg-green-100 text-green-800' : 
                                       ($script->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($script->status) }}
                                </span>
                            </div>
                            
                            <div class="relative">
                                <button onclick="toggleDropdown('{{ $script->id }}')" class="p-1 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>
                                <div id="dropdown-{{ $script->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border">
                                    <button onclick="viewScript('{{ $script->id }}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        View Full Script
                                    </button>
                                    <button onclick="copyScript('{{ addslashes($script->content) }}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Copy Content
                                    </button>
                                    <button onclick="downloadScript('{{ $script->title }}', '{{ addslashes($script->content) }}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Download as TXT
                                    </button>
                                    <hr class="my-1">
                                    <button onclick="deleteScript('{{ $script->id }}')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Delete Script
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $script->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($script->content, 120) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $script->created_at->diffForHumans() }}</span>
                            <span>{{ Str::words($script->content, 0, '') ? count(explode(' ', $script->content)) : 0 }} words</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No scripts yet</h3>
                <p class="text-gray-500 mb-6">Generate your first script to get started</p>
                <button onclick="generateScript()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg flex items-center mx-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Generate Your First Script
                </button>
            </div>
        @endif
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

    <!-- Generate Script Modal (same as dashboard) -->
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
        
        // Search and filter functionality
        document.getElementById('searchInput').addEventListener('input', filterScripts);
        document.getElementById('nicheFilter').addEventListener('change', filterScripts);
        document.getElementById('statusFilter').addEventListener('change', filterScripts);
        
        function filterScripts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const nicheFilter = document.getElementById('nicheFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const cards = document.querySelectorAll('.script-card');
            
            cards.forEach(card => {
                const title = card.dataset.title;
                const niche = card.dataset.niche;
                const status = card.dataset.status;
                
                const matchesSearch = title.includes(searchTerm);
                const matchesNiche = !nicheFilter || niche === nicheFilter;
                const matchesStatus = !statusFilter || status === statusFilter;
                
                if (matchesSearch && matchesNiche && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        function toggleDropdown(scriptId) {
            const dropdown = document.getElementById(`dropdown-${scriptId}`);
            // Close all other dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                if (d.id !== `dropdown-${scriptId}`) {
                    d.classList.add('hidden');
                }
            });
            dropdown.classList.toggle('hidden');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                    d.classList.add('hidden');
                });
            }
        });
        
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
                showNotification('Script copied to clipboard!', 'success');
            });
        }
        
        function copyModalContent() {
            navigator.clipboard.writeText(currentScriptContent).then(() => {
                showNotification('Script copied to clipboard!', 'success');
            });
        }
        
        function downloadScript(title, content) {
            const element = document.createElement('a');
            const file = new Blob([content], {type: 'text/plain'});
            element.href = URL.createObjectURL(file);
            element.download = `${title}.txt`;
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
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
        
        // Generate script functions (same as dashboard)
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
            
            const btnText = document.getElementById('generateBtnText');
            const spinner = document.getElementById('generateSpinner');
            btnText.textContent = 'Generating...';
            spinner.classList.remove('hidden');
            
            fetch('/generate-script', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    closeGenerateModal();
                    showNotification('Script generation triggered! Check back in a few minutes.', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    showNotification('Error triggering generation', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error triggering generation', 'error');
            })
            .finally(() => {
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
        
        // Close modals on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeGenerateModal();
            }
        });
    </script>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>