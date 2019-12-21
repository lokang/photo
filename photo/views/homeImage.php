<div class="card border-light mt-2">
    <div class="card-header">
        <div class="row">
            <div class="col-9">
                <p><?=$image['createdDate']?>  <span class="badge badge-pill badge-secondary">By <?= $image['userName']?></span></p>
                <?=$image['name']?>
            </div>
            <div class="col-3">
                <?php if($this->auth['id'] == $image['userId']): ?>
                <a class="btn btn-secondary btn-sm" href="/image/edit/<?=$image['id']?>">Edit</a>
                <a class="btn btn-danger btn-sm" href="/image/destroy/<?=$image['id']?>">Delete</a>
                <?php endIf; ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <img class="card-img-top" src="/images/<?=$image['image']?>">
        <p><?=$image['description']?></p>
    </div>
    <div class="card-header" id="comments">
        comments
    </div>

    <div class="card-body">
        <?php if($comments): ?>
            <?php foreach($comments as $comment):?>
                <p><?=$comment['createdDate']?> <span class="badge badge-pill badge-secondary"> By <?=$comment['userName']?></span></p>
                <p><?=$comment['message'] ?></p>
                <?php if($this->auth['id'] == $comment['userId']) :?>
                     <a class="btn btn-secondary btn-sm" href="/comment/edit/<?=$comment['id']?>">Edit</a> <a class="btn btn-danger btn-sm" href="/comment/destroy/<?=$comment['id']?>">Delete</a>
                <?php endIf ?>
                <hr>
            <?php endForeach ?>
        <?php else:?>
            <p>There are no comments yet</p>
        <?php endIf ?>
    </div>

    <?php if($this->auth) :?>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" class="form-control" placeholder="Enter message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary">Create</button>
                </form>
            </div>
    <?php else: ?>
        <div class="card-body">
            <div class="alert alert-danger">
                <a href="/home/login">Login</a> <a href="/home/register">Register</a>
            </div>
        </div>
    <?php endIf; ?>

</div>