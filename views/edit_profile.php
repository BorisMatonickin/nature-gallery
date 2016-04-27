<div class="col_1">
    <div class="contact-form">
        <h3>Edit Profile Info:</h3>
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" 
                       value="<?= (isset($userDetails['username'])) ? $userDetails['username'] : $input->getParam('username'); ?>" />
                <span class="text-danger"><?= (isset($errors['username'])) ? $errors['username'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" <?php if ($userDetails['gender'] === 'female') { echo 'checked'; } ?>/>Female
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" <?php if ($userDetails['gender'] === 'male') { echo 'checked'; } ?>/>Male
                </label>
                <span class="text-danger radio-error"><?= (isset($errors['gender'])) ? $errors['gender'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" name="firstName" id="firstName" 
                       value="<?= (isset($userDetails['first_name'])) ? $userDetails['first_name'] : $input->getParam('firstName'); ?>" />
                <span class="text-danger"><?= (isset($errors['firstName'])) ? $errors['firstName'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" name="lastName" id="lastName" 
                       value="<?= (isset($userDetails['last_name'])) ? $userDetails['last_name'] : $input->getParam('lastName'); ?>" />
                <span class="text-danger"><?= isset($errors['lastName']) ? $errors['lastName'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" id="city" 
                       value="<?= (isset($userDetails['city'])) ? $userDetails['city'] : $input->getParam('city'); ?>" />
                <span class="text-danger"><?= (isset($errors['city'])) ? $errors['city'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" name="state" id="state" 
                       value="<?= (isset($userDetails['state'])) ? $userDetails['state'] : $input->getParam('state'); ?>" />
                <span class="text-danger"><?= (isset($errors['state'])) ? $errors['state'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" name="country" id="country" 
                       value="<?= (isset($userDetails['country'])) ? $userDetails['country'] : $input->getParam('country'); ?>" />
                <span class="text-danger"><?= (isset($errors['country'])) ? $errors['country'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="about">About Me:</label>
                <textarea class="form-control" name="about" id="about"><?= (isset($userDetails['about'])) ? $userDetails['about'] : $input->getParam('about'); ?></textarea>
                <span class="text-danger"><?= (isset($errors['about'])) ? $errors['about'] : ''; ?></span>
            </div>
            <input type="hidden" name="token" value="<?= $token; ?>" />
            <input type="submit" name="update" id="update" value="Update" class="btn btn-lg btn-primary btn-block" />  
        </form>
    </div> 
</div>
