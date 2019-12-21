<div class="card border-light mt-2">
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input class="form-control" type="text" name="name" value="<?=$image['name']?>" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" placeholder="Enter description" required><?=$image['description']?></textarea>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="private" name="private" <?=$image['private'] == 1 ? 'checked' : '' ?>>
                <label class="custom-control-label" for="private">private</label>
            </div>
            <button class="btn btn-secondary btn-sm" type="submit">Edit</button>
        </form>
        <div class="alert alert-warning mt-2">
            If you want to change image, <a  href="/image/destroy/<?=$image['id']?>"> delete</a> this one and upload a new one.
        </div>
    </div>
</div>