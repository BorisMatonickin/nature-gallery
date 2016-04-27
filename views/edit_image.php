<div class="grid_1">
    <div class="col-md-8">
        <img src="/img/<?= $image['name']; ?>" alt="" class="img-responsive img-center" title="<?= $image['caption']; ?>" />
    </div>
    
    <div class="col-md-4">
        <h3>Edit Image Details:</h3>
        <form action="" method="post" role="form">
            <div class="form-group">
                <label for="caption">Image Title:</label>
                <input type="text" class="form-control" name="caption" id="caption" 
                       value="<?= (isset($image['caption'])) ? $image['caption'] : $input->getParam('caption'); ?>" />
                <span class="text-danger"><?= isset($errors['caption']) ? $errors['caption'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Image Description:</label>
                <textarea class="form-control" name="description" id="description"><?= (isset($image['description'])) ? $image['description'] : $input->getParam('description'); ?></textarea>
                <span class="text-danger"><?= isset($errors['description']) ? $errors['description'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label>Image Category:</label>
                <select name="category" class="form-control">
                    <option value="">Please Choose...</option>
                    <?php foreach($categories as $id => $category): ?>
                        <option value="<?= $id ?>" <?php if ($image['category'] === $category['category']) { echo ' selected="selected"'; } ?>><?= $category['category']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger"><?= isset($errors['category']) ? $errors['category'] : ''; ?></span>
            </div>
            
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
            <input type="submit" name="update" id="update" value="Update" class="btn btn-md btn-primary btn-block" />
        </form>
    </div>
</div>
<div class="clearfix"></div>


