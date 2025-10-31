<!-- Edit Script Modal -->
<div id="editScriptModal" class="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">Edit Script</h3>
        </div>
        
        <form id="editScriptForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="edit_title">Title</label>
                <input type="text" class="form-input" id="edit_title" name="title" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="edit_description">Description</label>
                <textarea class="form-textarea" id="edit_description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="edit_content">Script Content</label>
                <textarea class="form-textarea" id="edit_content" name="content" rows="10" 
                    style="font-family: monospace; font-size: 14px;"></textarea>
            </div>
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('editScriptModal')">
                Cancel
            </button>
            <button type="button" class="btn btn-primary" onclick="submitForm('editScriptForm')">
                Save Changes
            </button>
        </div>
    </div>
</div>