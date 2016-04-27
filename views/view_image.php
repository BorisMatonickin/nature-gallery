<div class="grid_1">
    <div class="col-md-8">
        <img src="/img/<?= $image['name']; ?>" alt="" class="img-responsive img-center" title="<?= $image['caption']; ?>" />
    </div>
    
    <div class="col-md-4">
        <div class="clearfix">
            <a href="/profile/view/<?= $image['user_id']; ?>"><h4 class="pull-left"><?= $image['username']; ?></h4></a>
	<?php if (isset($sessionUser['loggedIn']) && $sessionUser['loggedIn'] && ($sessionUser['userId'] === $image['user_id'])) : ?>
	    <div class="nav-icons">
	        <a href="/images/edit/<?= $image['image_id']; ?>" title="Edit Image">
		<span class="glyphicon glyphicon-pencil"></span>
	        </a>
	        <a href="/images/delete/<?= $image['image_id']; ?>" title="Delete Image">
		<span class="glyphicon glyphicon-remove"></span>
	        </a>
	    </div>
	<?php endif; ?>
        </div>
        <small class="sub-text"><?= $image['date_created']; ?></small>
        <h3><?= $image['caption']; ?></h3>
        <p><em><?= $image['description']; ?></em></p>

        <ul class="comment-list">
            <?php foreach ($comments as $id => $comment): ?>
                <li>
                    <div class="clearfix commenter-image">
                         <img src="/img/avatar3.png" alt="" />
                         <a href="/profile/view/<?= $comment['user_id']; ?>" class="comm-username"><?= $comment['username']; ?></a>
                    </div>
                    <div class="comment-text">
                        <p><?= $comment['comment']; ?></p>
                        <span class="date sub-text"><?= $comment['date_created']; ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ((isset($sessionUser['loggedIn'])) && $sessionUser['loggedIn']): ?>
            <form role="form" class="clearfix" method="post" action="">
                <input type="hidden" name="token" value="<?= $token; ?>" />
                <input type="hidden" name="userId" id="userId" value="<?= $sessionUser['userId']; ?>" />
                <input type="hidden" name="imageId" id="imageId" value="<?= $image['image_id']; ?>" />

                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" id="comment" name="comment" placeholder="Your comment..." value="<?= $input->getParam('comment'); ?>" />                    
                    <span class="text-danger"><?= (isset($errors['comment'])) ? $errors['comment'] : ''; ?></span>
                </div>

                <div class="col-md-12 form-group text-right">
                    <input type="submit" name="submitComment" id="submitComment" value="Post" class="btn btn-primary btn-sm" /> 
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<div class="clearfix"></div>

<h4 class="text-center">Other images from <a href="/profile/view/<?= $image['user_id']; ?>"><?= $image['username']; ?></a></h4>
<div class="row">
    <?php foreach ($userImages as $id => $image): ?>
        <div class="col-md-2">
            <a href="/images/view/<?= $id; ?>" class="thumbnail">
                <img src="/img/<?= $image['name']; ?>" alt="" class="img-responsive" title="<?= $image['caption']; ?>" />
            </a>
        </div>
    <?php endforeach; ?>
</div>

