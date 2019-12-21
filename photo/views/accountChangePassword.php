<div class="card border-light mt-2">
    <div class="card-header">
        change password
    </div>

    <div class="card-body">
        <p class="alert alert-warning">If you change password, you will be redirected to login page where you have to enter your new password</p>
        <?=$this->errors(); ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input class="form-control" id="newPassword" name="newPassword" type="password" placeholder="Enter new password" required>
            </div>
            <button class="btn btn-secondary" type="submit">change password</button>
        </form>
    </div>
</div>