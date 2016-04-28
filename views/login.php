<div class="grid_1">    
    <?php if (!empty($loginError)): ?>
        <div class="alert alert-danger"><?= $loginError; ?></div>
    <?php endif; ?>

    <div class="contact-form">
        <h3>Login: </h3>
        <form action="" method="post" role="form" autocomplete="off">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $input->getParam('username') ?>" />
                <span class="text-danger"><?= isset($errors['username']) ? $errors['username'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $input->getParam('password'); ?>" />
                <span class="text-danger"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
            </div>
            <input type="hidden" name="token" value="<?= $token; ?>" />
            <input type="submit" id="login" name="login" value="Login" class="btn btn-lg btn-primary btn-block" />
        </form>
    </div>
</div>        
    
