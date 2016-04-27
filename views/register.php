<div class="grid_1">    
    <div class="contact-form">
        <h3>Register: </h3>
        <form action="" method="post" role="form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $input->getParam('username'); ?>" />
                <span class="text-danger"><?= isset($errors['username']) ? $errors['username'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $input->getParam('email'); ?>" />
                <span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $input->getParam('password'); ?>" />
                <span class="text-danger"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="passwordConfirm">Confirm Password:</label>
                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" value="<?= $input->getParam('passwordConfirm'); ?>" />
                <span class="text-danger"><?= isset($errors['passwordConfirm']) ? $errors['passwordConfirm'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" <?php if ($input->getParam('gender') === 'female') { echo 'checked'; } ?> />Female
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" <?php if ($input->getParam('gender') === 'male') { echo 'checked'; } ?> />Male
                </label>
                <span class="text-danger radio-error"><?= isset($errors['gender']) ? $errors['gender'] : ''; ?></span>
            </div>
            <img src="<?= $captcha; ?>" alt="" />
            <div class="form-group">
                <label for="captcha">Enter Code:</label>
                <input class="form-control" id="captcha" name="captcha" maxlength="6" />
                <span class="text-danger"><?= isset($errors['captcha']) ? $errors['captcha'] : ''; ?></span>
            </div>
            <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
            <input type="submit" id="register" name="register" value="Register" class="btn btn-lg btn-primary btn-block" /> 
        </form>
    </div>
</div>

