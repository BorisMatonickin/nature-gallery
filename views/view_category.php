<div class="grid_1">
    <div class="col-md-3">
        <h4><?= $category['category']; ?></h4>
        <p><em><?= $category['description']; ?></em></p>
    </div>
    <div class="col-md-8">
        <h4>Images</h4>
        <?php foreach ($images as $id => $image): ?>
	<div class="col-md-4">
	    <a href="/images/view/<?= $image['image_id']; ?>" class="thumbnail">
	        <img src="/img/<?= $image['name']; ?>" class="img-responsive" id="gall-img" alt="" title="<?= $image['caption']; ?>" />
	    </a>
	</div>
        <?php endforeach; ?>
    </div>
    <div class="clearfix"></div>
</div>
