<div class="card border-light mt-2">
    <div class="card-body">
        Are you sure you want to delete?
        <form action="" method="post">
            <input type="hidden" name="delete" value="delete">
            <button class="btn btn-danger btn-sm" type="submit">Yes</button>
            <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-secondary btn-sm">No</a>
        </form>
    </div>
</div>