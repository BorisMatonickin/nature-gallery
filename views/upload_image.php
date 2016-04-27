<div class="grid_1">
    <div class="contact-form">
        <h3>Upload New Image:</h3>
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="caption">Image Title:</label>
                <input type="text" class="form-control" name="caption" id="caption" placeholder="Enter Image Title" value="<?= $input->getParam('caption'); ?>" />
                <span class="text-danger"><?= isset($errors['caption']) ? $errors['caption'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Image Description:</label>
                <textarea class="form-control" name="description" id="description" placeholder="Enter Image Description"><?= $input->getParam('description'); ?></textarea>
                <span class="text-danger"><?= isset($errors['description']) ? $errors['description'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label>Image Category:</label>
                <select name="category" class="form-control">
                    <option value="">Please Choose...</option>
                    <?php foreach($categories as $id => $category): ?>
                        <?php $cat = $input->getParam('category'); ?>
                        <option value="<?= $id ?>" <?php if (!empty($cat) && ($cat == $id)) { echo ' selected="selected"'; } ?>><?= $category['category']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-danger"><?= isset($errors['category']) ? $errors['category'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" name="image" id="image" />
                <span class="text-danger"><?= isset($uploadError) ? $uploadError : '' ?></span>
            </div>
            <img src="<?= $captcha; ?>" alt="" />
            <div class="form-group">
                <label for="captcha">Enter Code:</label>
                <input class="form-control" id="captcha" name="captcha" maxlength="6" />
                <span class="text-danger"><?= isset($errors['captcha']) ? $errors['captcha'] : ''; ?></span>
            </div>
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
            <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-lg btn-primary btn-block" />
        </form>
    </div>
</div>

