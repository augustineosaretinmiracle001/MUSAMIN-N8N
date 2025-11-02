<!-- Generate Script Modal -->
<div x-data="generateScriptModal()" x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md lg:max-w-2xl w-full" x-transition>
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Generate New Script</h3>
                <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form @submit.prevent="triggerGeneration()" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Niche</label>
                        <input x-model="form.niche" type="text" placeholder="e.g., Storytelling, Education, Business, Technology" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Title (Optional)</label>
                        <input x-model="form.title" type="text" placeholder="Enter a specific title..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Topic (Optional)</label>
                        <input x-model="form.topic" type="text" placeholder="Enter a specific topic..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Instructions</label>
                        <textarea x-model="form.instructions" rows="3" placeholder="Any specific requirements..." 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                </form>
            </div>
            <div class="flex items-center justify-end p-6 border-t bg-gray-50">
                <button @click="triggerGeneration()" :disabled="loading" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50">
                    <span x-show="!loading">Generate Script</span>
                    <span x-show="loading" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Generating...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function generateScriptModal() {
        return {
            open: false,
            loading: false,
            form: {
                niche: '',
                title: '',
                instructions: ''
            },
            
            openModal() {
                this.open = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeModal() {
                this.open = false;
                document.body.style.overflow = 'auto';
                this.resetForm();
            },
            
            resetForm() {
                this.form = {
                    niche: '',
                    title: '',
                    instructions: ''
                };
                this.loading = false;
            },
            
            async triggerGeneration() {
                this.loading = true;
                
                try {
                    const response = await fetch('https://n8n.musamin.app/webhook/trigger-generation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user_uuid: '{{ auth()->user()->id }}',
                            niche: this.form.niche,
                            title: this.form.title,
                            instructions: this.form.instructions,
                            triggered_at: new Date().toISOString()
                        })
                    });
                    
                    const result = await response.json();
                    console.log('Script generation triggered:', result);
                    
                    this.closeModal();
                    this.showNotification('Script generation started! Check back in a few minutes.', 'success');
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                    
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Error connecting to n8n. Please try again.', 'error');
                } finally {
                    this.loading = false;
                }
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
    window.generateScript = function() {
        // Find the Alpine component and call openModal
        const modalElement = document.querySelector('[x-data*="generateScriptModal"]');
        if (modalElement && modalElement._x_dataStack) {
            modalElement._x_dataStack[0].openModal();
        }
    }
</script>