<div class="col_1">
    <div class="contact-form">
        <h3>Change Profile Image:</h3>
        <p>Current Image:</p>
        <img src="/img/<?= (isset($profileImage)) ? $profileImage : 'avatar3.png'; ?>" alt="" />
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profileImage">Choose Another Image:</label>
                <input type="file" name="profileImage" id="profileImage" />
                <span class="text-danger"><?= isset($uploadError) ? $uploadError : '' ?></span>
            </div>
            <img src="<?= $captcha; ?>" alt="" />
            <div class="form-group">
                <label for="captcha">Enter Code:</label>
                <input class="form-control" id="captcha" name="captcha" maxlength="6" />
                <span class="text-danger"><?= isset($errors['captcha']) ? $errors['captcha'] : ''; ?></span>
            </div>
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
            <input type="submit" id="uploadImage" name="uploadImage" value="Save" class="btn btn-lg btn-primary btn-block" />
        </form>
    </div>
</div>

