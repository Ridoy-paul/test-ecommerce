<div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-labelledby="globalDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this news item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a type="button" href="" id="globalDeleteConfirmButton" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
  </div>

  <script>
    function globalDeleteConfirm(url) {
        $("#globalDeleteConfirmButton").attr("href", url);
    }
  </script>