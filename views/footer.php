
        <div class="grid_2"> 
            <ul id="footer-links">
                    <li><a href="/">Home</a></li>
	        <li><a href="/categories">Categories</a></li>
                <?php if ($session->isUserLoggedIn() === true): ?>
                    <?php $userInfo = $session->get('user'); ?>
                    <li><a href="/profile/view/<?= $userInfo['userId']; ?>">Profile</a></li>
                    <li><a href="/logout">Log Out</a></li>
                <?php elseif ($session->isUserLoggedIn() === false): ?>
                    <li><a href="/login">Log In</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
                    <li><a href="/contact">Contact Us</a></li> 
            </ul>
            <p>Copyright © 2015 Nature Gallery. All Rights Reserved.</p>
        </div>  
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>