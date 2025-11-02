<x-app-layout>
    <div class="mb-6">
        <div class="flex items-center mb-4">
            <a href="{{ route('settings') }}" class="text-gray-500 hover:text-gray-700 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">API Configuration</h1>
        </div>
        <p class="text-gray-600">Manage your API tokens and integration settings</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
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

    <script>
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
    </script>
</x-app-layout>