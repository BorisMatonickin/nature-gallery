<div class="grid_1">
    <div class="col-md-3">
        <img src="/img/<?= (isset($userDetails['profile_image'])) ? $userDetails['profile_image'] : 'avatar3.png'; ?>" alt="" />
        <?php if (isset($sessionUser['userId']) && ($userDetails['user_id'] === $sessionUser['userId'])): ?>
            <a href="/profile/upload/<?= $userDetails['user_id']; ?>" class="btn btn-primary btn-sm">Change Profile Image</a>
        <?php endif; ?>
        <h4><?= $userDetails['username']; ?></h4>
        
        <?php if (isset($userDetails['first_name']) && isset($userDetails['last_name'])): ?>
            <p><em><?= $userDetails['first_name'] . ' ' . $userDetails['last_name']; ?></em></p>
        <?php endif; ?>
            
        <?php if (isset($userDetails['city'])): ?>
            <p><em><?= $userDetails['city']; ?></em></p>
        <?php endif; ?>
        
        <?php if (isset($userDetails['state']) && (isset($userDetails['country']))): ?>
            <p><em><?= $userDetails['state'] . ', ' . $userDetails['country']; ?></em></p>
        <?php elseif (isset($userDetails['country'])): ?>
            <p><em><?= $userDetails['country']; ?></em></p>
        <?php endif; ?>
        
        <?php if (isset($userDetails['about'])): ?>
            <p><em><?= $userDetails['about']; ?></em></p>
        <?php endif; ?>
         
        <?php if (isset($sessionUser['userId']) && ($userDetails['user_id'] === $sessionUser['userId'])): ?>
            <div class="clearfix">
                <a href="/profile/edit/<?= $userDetails['user_id']; ?>" class="btn btn-primary btn-sm pull-left">Edit Info</a>
                <a href="/images/upload" class="btn btn-primary btn-sm pull-right">Upload New Image</a>
            </div>  
        <?php endif; ?>

    </div>
    <div class="col-md-8">
        <?php if(empty(array_filter($userImages))): ?>
            <h4>No images to display yet.</h4>
        <?php else: ?>
            <h4>My Images</h4>
            <?php foreach ($userImages as $id => $image): ?>
                <div class="col-md-4">
                    <a href="/images/view/<?= $id; ?>" class="thumbnail">
                        <img src="/img/<?= $image['name']; ?>" class="img-responsive" id="gall-img" alt="" title="<?= $image['caption']; ?>" />
                    </a>
                </div>
            <?php endforeach; ?>            
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
</div>
