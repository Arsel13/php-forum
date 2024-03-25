<!-- Categories Modal -->
<div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriesModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Categories Form -->
                <form action="partials/_categories_handle.php" method="POST">
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Categories Name</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="cat_desc" class="form-label">Categories Description</label>
                        <textarea name="cat_desc" id="cat_desc" rows="5" class="form-control"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>