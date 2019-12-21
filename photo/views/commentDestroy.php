<div class="card border-light mt-2">
    <div class="card-body">
        Are you sure you want to delete comment?
        <form action="" method="post">
            <input type="hidden" name="destroy" value="1">
            <button class="btn btn-danger btn-sm" type="submit">Yes</button>
            <a href="/home/image/<?=$comment['imageId']?>#comments" class="btn btn-secondary btn-sm">No</a>
        </form>
    </div>
</div>