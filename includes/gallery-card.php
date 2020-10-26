<div class = "col-md-3">
    <a href = "review.php?id=<?php echo($row['pid']); ?>">
        <img src = "<?php echo($row['picpath']); ?>">
        <h3><?php echo($row['title']); ?><h3>
        <p><?php echo($row['description']); ?></p>
    </a>
</div>