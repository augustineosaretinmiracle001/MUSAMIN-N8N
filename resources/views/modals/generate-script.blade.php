<!-- Generate Script Modal -->
<div id="generateScriptModal" class="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">Generate New Script</h3>
        </div>
        
        <form id="generateScriptForm" method="POST" action="{{ route('scripts.generate') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="script_type">Script Type</label>
                <select class="form-select" id="script_type" name="script_type" required>
                    <option value="">Select script type...</option>
                    <option value="automation">Automation Script</option>
                    <option value="data-processing">Data Processing</option>
                    <option value="web-scraping">Web Scraping</option>
                    <option value="api-integration">API Integration</option>
                    <option value="custom">Custom Script</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-textarea" id="description" name="description" rows="4" 
                    placeholder="Describe what you want the script to do..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="language">Programming Language</label>
                <select class="form-select" id="language" name="language">
                    <option value="python">Python</option>
                    <option value="javascript">JavaScript</option>
                    <option value="php">PHP</option>
                    <option value="bash">Bash</option>
                    <option value="powershell">PowerShell</option>
                </select>
            </div>
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('generateScriptModal')">
                Cancel
            </button>
            <button type="button" class="btn btn-primary" onclick="submitForm('generateScriptForm')">
                Generate Script
            </button>
        </div>
    </div>
</div>