<div class="card border-light mt-2">
    <div class="card-body">
        <?=$this->errors();?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$this->auth['name']?>" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?=$this->auth['email']?>" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>
</div>