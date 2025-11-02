<x-app-layout>
    <div class="mb-6">
        <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Scripts</h1>
                <p class="text-gray-600 mt-1">Manage all your generated scripts</p>
            </div>
            
            <button onclick="generateScript()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Generate New Script
            </button>
        </div>
        
        <!-- Search and Count -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="relative flex-1 max-w-md">
                <input type="text" id="searchInput" placeholder="Search scripts..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
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
                         data-niche="{{ $script->niche }}" data-status="{{ $script->getStatus() }}" data-title="{{ strtolower($script->title) }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($script->niche) }}
                                </span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $script->getStatus() === 'done' ? 'bg-green-100 text-green-800' : 
                                       ($script->getStatus() === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($script->getStatus()) }}
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
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $script->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($script->content, 120) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $script->created_at->diffForHumans() }}</span>
                            <span>{{ str_word_count($script->content) }} words</span>
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

    <!-- Include Modals -->
    @include('modals.generate-script')
    @include('modals.view-script')
    
    <!-- Old modal removed -->
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

        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', filterScripts);
        
        function filterScripts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.script-card');
            
            cards.forEach(card => {
                const title = card.dataset.title;
                const matchesSearch = title.includes(searchTerm);
                
                if (matchesSearch) {
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
        
        // viewScript function is now handled by the view-script modal component
        
        function copyScript(content) {
            navigator.clipboard.writeText(content).then(() => {
                showNotification('Script copied to clipboard!', 'success');
            });
        }
        

        
        function downloadScript(title, content) {
            // Clean the content by removing extra slashes
            const cleanContent = content.replace(/\\n/g, '\n').replace(/\\'/g, "'").replace(/\\"/g, '"');
            
            const element = document.createElement('a');
            const file = new Blob([cleanContent], {type: 'text/plain'});
            element.href = URL.createObjectURL(file);
            element.download = `${title.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.txt`;
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
            
            showNotification('Script downloaded successfully!', 'success');
        }
        

        
        // generateScript function is now handled by Alpine.js modal
        
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