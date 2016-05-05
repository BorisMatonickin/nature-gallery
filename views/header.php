<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Nature Gallery</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
            integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
            integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/default.css" />
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav class="top-nav">
                    <ul class="nav nav-pills pull-right">
                            <li role="presentation" class="active"><a href="/">Home</a></li>
		    <li role="presentation"><a href="/categories">Categories</a></li>
                        <?php if ($session->isUserLoggedIn() === true): ?>
                            <?php $userInfo = $session->get('user'); ?>
                            <li role="presentation"><a href="/profile/view/<?= $userInfo['userId']; ?>">Profile</a></li>
                            <li role="presentation"><a href="/logout">Log Out</a></li>
                        <?php elseif ($session->isUserLoggedIn() === false):  ?>
                            <li role="presentation"><a href="/login">Log In</a></li>
                            <li role="presentation"><a href="/register">Register</a></li>
                        <?php endif; ?>                        
                            <li role="presentation"><a href="/contact">Contact Us</a></li>
                    </ul>
                </nav>
                <h2 class="text-muted logo">Nature Gallery</h2>
            </div>
            <!-- <div class="jumbotron" style="background: url('/img/nature1.jpg') center center">
                <p class="lead white-text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, 
                    tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            </div> -->
            <?php if ($session->hasFlash()): ?>
                <div class="<?= $session->addAlertClass(); ?>" role="alert">
                    <?= $session->getFlashMessage(); ?>
                </div>
            <?php endif; ?>