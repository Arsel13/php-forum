<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for an iCode Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Signup Form -->
                <form action="partials/_signup_handle.php" method="POST">
                    <div class="mb-3">
                        <label for="sign-uname" class="form-label">Username</label>
                        <input type="text" class="form-control" id="sign-uname" name="sign-uname" required>
                    </div>
                    <div class="mb-3">
                        <label for="sign-pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="sign-pass" name="sign-pass" required>
                    </div>
                    <div class="mb-3">
                        <label for="sign-cpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="sign-cpass" name="sign-cpass" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
        </div>
    </div>
</div>