<div class = "col-md-3">
    <a href = "review.php?id=<?php echo($row['projectId']); ?>">
        <img src = "<?php echo($row['icon']); ?>">
        <h3><?php echo($row['title']); ?><h3>
        <p><?php echo($row['description']); ?></p>
    </a>
</div>