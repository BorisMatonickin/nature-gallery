<div class="grid_1">
    <?php foreach ($categories as $catId => $category): ?>
    <h4 class="text-center"><a href="/categories/view/<?= $catId; ?>"><?= $category['category']; ?></a></h4>
        <div class="row">
	<?php $imagesWithId = explode(',', $category['images']); ?>
	<?php foreach ($imagesWithId as $key => $partial): ?>
	    <?php
	        // for each category images are stored as string containing (image id - image name) pair
	        // after explode function first index of array is id and second is image name
	        $imageWithId = explode('-', $partial);
	        $id = $imageWithId[0];
	        $image = $imageWithId[1];
	    ?>
	    <div class="col-md-2">
	        <a href="/images/view/<?= $id; ?>" class="thumbnail">
		<img src="/img/<?= $image; ?>" alt="" class="img-responsive" />
	        </a>
	    </div>
	<?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>