<?php if($images) : ?>
    <?php $i = 0; foreach($images as $image) :?>
        <?php $i++ ?>
        <div class="card border-light mt-2 <?= $i > config('itemsPerPage') ? 'cardHidden' : false; ?>">
            <div class="card-header">
                <a href="/home/image/<?=$image['id']?>"><?=$image['name']?></a>
            </div>
            <div class="card-body">
                <a href="/home/image/<?=$image['id']?>"><img class="card-img-top imgHeight" src="/images/<?=$image['image']?>"></a>
                <p class="card-text mt-2"><?=$image['description']?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="card border-light mt-2" id="loadMore">
        <div class="card-body">
            <button type="button" class="btn btn-secondary" onclick="loadMore(<?=config('itemsPerPage')?>)">Load more</button>
        </div>
    </div>
<?php else: ?>
    <div class="card border-light mt-2">
        <div class="card-body">
            <div class="alert alert-warning">
                There are no photos.
            </div>
        </div>
    </div>

<?php endif; ?>
