<?php
if(!isset($comment)) {
    $comment = [];
    $postId = 1;
}
?>
<div class="tm-comment tm-mb-45">
    <figure class="tm-comment-figure">
        <img src="img/comment-<?php echo mt_rand(1,2); ?>.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
        <figcaption class="tm-color-primary text-center"><?php echo $comment['username']; ?></figcaption>
    </figure>
    <div>
        <p>
            <?php echo $comment['content']; ?>
        </p>
        <div class="d-flex justify-content-between">
            <a href="#" class="tm-color-primary">REPLY</a>
            <span class="tm-color-primary"><?php echo date("d.m.Y", strtotime($comment['created_at'])); ?></span>
        </div>
    </div>
    <a href="delete-post-comment.php?comment-id=<?php echo $comment['id']; ?>&post-id=<?php echo $postId; ?>">Delete</a>
</div>