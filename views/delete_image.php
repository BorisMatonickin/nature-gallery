<div class="grid_1">
    <div class="col-md-8">
        <img src="/img/<?= $image['name']; ?>" alt="" class="img-responsive img-center" title="<?= $image['caption']; ?>" />
    </div>
    <div class="col-md-4">
        <h3>Deleting image:</h3>
        <p>Are you shure you want to delete this image?</p>
        <form action="" method="post" role="form">
	<input type="hidden" name="token" value="<?= $token; ?>" />
	<input type="submit" id="delete" name="delete" value="Delete" class="btn btn-sm btn-primary" />
	<input type="submit" id="cancel" name="cancel" value="Cancel" class="btn btn-sm btn-primary" />
        </form>
    </div>
</div>
<div class="clearfix"></div>

