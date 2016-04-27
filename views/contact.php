<div class="grid_1">    
    <div class="contact-form">
        <h3>Contact Us: </h3>
        <form action="" method="post" role="form">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?= $input->getParam('name'); ?>" />
	    <span class="text-danger"><?= (isset($errors['name'])) ? $errors['name'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $input->getParam('email'); ?>" />
	    <span class="text-danger"><?= (isset($errors['email'])) ? $errors['email'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea name="message" id="message" class="form-control" placeholder="Your Message"><?= $input->getParam('message'); ?></textarea>
	    <span class="text-danger"><?= (isset($errors['message'])) ? $errors['message'] : ''; ?></span>
            </div>
	<img src="<?= $captcha; ?>" alt="" />
	<div class="form-group">
	    <label for="captcha">Enter Code:</label>
	    <input class="form-control" id="captcha" name="captcha" maxlength="6" />
	    <span class="text-danger"><?= (isset($errors['captcha'])) ? $errors['captcha'] : ''; ?></span>
	</div>
	<input type="hidden" id="token" name="token" value="<?= $token; ?>" />
            <input type="submit" id="contact" name="contact" value="Send" class="btn btn-lg btn-primary btn-block" /> 
        </form>
    </div>
</div>

