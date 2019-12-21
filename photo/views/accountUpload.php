<div class="card border-light mt-2">
    <div class="card-header">
        Upload
    </div>
    <div class="card-body">
        <form action="/account/upload" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea type="text" id="description" name="description" class="form-control" placeholder="Enter Description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Picture:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="private" name="private">
                <label class="custom-control-label" for="private">private</label>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>