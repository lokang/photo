<?php $i = 0; foreach($images as $image):?>
    <?php $i++ ?>
    <div class="card border-light mt-2 <?= $i > config('itemsPerPage') ? 'cardHidden' : false; ?>"
         xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <a href="/home/image/<?=$image['id']?>"><?=$image['name']?></a>
        </div>
        <div class="card justify-content-center border-light" style="margin: 0; min-height: 350px; background-color: black">
            <a href="/home/image/<?=$image['id']?>"><img class="img-fluid " src="/images/<?=$image['image']?>" alt="Card image cap"></a>
        </div>
        <div class="card-body">
            <p class="card-text"><?=$image['description']?></p>

            <div class="row">
                <div class="col-9">

                    <?php
                        $_comments = new Comments();
                        $comments = $_comments->countAll($image['id']);
                    ?>
                    <p class="card-text">
                        <small class="text-muted">Uploaded on <?=$image['createdDate']?> by </small>
                        <a class="badge badge-pill badge-success" href="/account/photos/<?=$image['userId']?>"><?=$image['userName']?>(<?=$_images->countByUser($image['userId']) ?>)</a>
                        <a id="up<?=$image['id']?>" href="javascript:void(0)" style="color: gray" onclick="rating(<?=$image['id'] ?>, 'up')">
                            <i class="fas fa-thumbs-up" ></i>
                            (<span><?=$_rating->countVotes($image['id'], 'up') ?></span>)
                        </a>
                        <a id ="down<?=$image['id']?>" href="javascript:void(0)" style="color: red" onclick="rating(<?=$image['id'] ?>, 'down')">
                            <i class="fas fa-thumbs-down"></i>
                            (<span><?=$_rating->countVotes($image['id'], 'down') ?></span>)
                        </a>
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-secondary btn-sm" href="/home/image/<?=$image['id']?>">Comments(<?=$comments ?>)</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
<div class="card border-light mt-2" id="loadMore">
    <div class="card-body">
        <button type="button" class="btn btn-secondary" onclick="loadMore(<?=config('itemsPerPage')?>)">Load more</button>
    </div>
</div>