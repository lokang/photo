<div class="card border-light mt-2">
    <div class="card-header">
        login
    </div>

    <div class="card-body">
        <?=$this->errors(); ?>
        <form action="/home/login" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="Enter email" value="<?=$this->value('email'); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required>
            </div>
            <button class="btn btn-secondary" type="submit">Login</button>
        </form>
    </div>
</div>