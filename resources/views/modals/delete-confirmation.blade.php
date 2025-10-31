<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">Confirm Delete</h3>
        </div>
        
        <div style="margin: 16px 0;">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
        </div>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('deleteConfirmModal')">
                Cancel
            </button>
            <button type="button" class="btn" style="background: #dc2626; color: white;" onclick="submitForm('deleteForm')">
                Delete
            </button>
        </div>
    </div>
</div>