<div class="grid_1">
    <?php foreach ($categories as $catId => $category) : ?>
        <div class="col-md-2 col_1">
            <h4><?= $category['category']; ?></h4>
        </div>
        <?php $imagesWithId = explode(',', $category['images']); ?>
        <?php foreach($imagesWithId as $key => $partial) : ?>
            <?php
                // for each category images are stored as string containing (image id - image name) pair
                // after explode function first index of array is id and second is image name
                $imageWithId = explode('-', $partial);
                $id = $imageWithId[0];
                $image = $imageWithId[1];
            ?>
            <div class="col-md-2 col_1">
                <a href="/images/view/<?= $id; ?>"><img src="/img/<?= $image; ?>" class="img-responsive" id="gall-img" alt="<?= $category['category']; ?>" /></a>
            </div>
        <?php endforeach; ?>
        <div class="clearfix"> </div>  
    <?php endforeach; ?>
</div>

