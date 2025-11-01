<!-- View Script Modal -->
<div x-data="viewScriptModal()" x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden" x-transition>
            <div class="flex items-center justify-between p-6 border-b">
                <h3 x-text="scriptTitle" class="text-lg font-semibold text-gray-900"></h3>
                <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div x-html="scriptContent" class="prose max-w-none"></div>
            </div>
            <div class="flex items-center justify-end p-6 border-t bg-gray-50">
                <button @click="copyContent()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <span x-show="!copied">Copy Content</span>
                    <span x-show="copied">Copied!</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewScriptModal() {
        return {
            open: false,
            scriptTitle: '',
            scriptContent: '',
            scriptRawContent: '',
            copied: false,
            
            openModal(scriptId) {
                this.fetchScript(scriptId);
                this.open = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeModal() {
                this.open = false;
                document.body.style.overflow = 'auto';
                this.resetModal();
            },
            
            resetModal() {
                this.scriptTitle = '';
                this.scriptContent = '';
                this.scriptRawContent = '';
                this.copied = false;
            },
            
            async fetchScript(scriptId) {
                try {
                    const response = await fetch(`/scripts/${scriptId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        credentials: 'same-origin'
                    });
                    
                    const script = await response.json();
                    this.scriptTitle = script.title;
                    this.scriptRawContent = script.content;
                    this.scriptContent = `
                        <div class="mb-4">
                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full mb-2">
                                ${script.niche}
                            </span>
                        </div>
                        <div class="whitespace-pre-wrap">${script.content}</div>
                    `;
                } catch (error) {
                    console.error('Error loading script:', error);
                    this.showNotification('Error loading script', 'error');
                }
            },
            
            copyContent() {
                navigator.clipboard.writeText(this.scriptRawContent).then(() => {
                    this.copied = true;
                    setTimeout(() => {
                        this.copied = false;
                    }, 2000);
                });
            },
            
            showNotification(message, type) {
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
        }
    }
    
    // Global function to open modal from anywhere
    window.viewScript = function(scriptId) {
        const modalElement = document.querySelector('[x-data*="viewScriptModal"]');
        if (modalElement && modalElement._x_dataStack) {
            modalElement._x_dataStack[0].openModal(scriptId);
        }
    }
</script>