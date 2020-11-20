<div class = "col-md-12">
    <a style = "display: flex;" href = "review.php?id=<?php echo($row['projectId']); ?>">
        <img class = "col-md-3" style = "float: left; margin-bottom: 10px;" src = "<?php echo($row['icon']); ?>">
        <div style = "box-shadow: none; text-align: left;">
            <h3><?php echo($row['title']); ?> [Author: <?php require_once 'includes/controllers/profile-controller.php'; $profileInfo = $profileController->fetchProfileInfo($row['uploaderId']); echo($profileInfo['username']); ?>]<h3>
            <p><?php echo($row['description']); ?></p>
        </div>

    </a>
</div>