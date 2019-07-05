<?php
$connec = new PDO('mysql:dbname=9gag', 'root', '0000');
$post = $connec->prepare('SELECT
    post.id AS postID, message, image, created_at, user,
    user.id AS userID, name, lastname, imgProfil, description
    FROM post 
    JOIN user ON post.user=user.id
    WHERE post.id = :id');
$post->execute([
    ":id" => $_POST['postId'],
]);
$post = $post->fetch();

require_once(dirname(__DIR__) . '/layouts/header.php');
// var_dump($post);die;
?>
<form enctype="multipart/form-data" action="/db/editPost.php" method="post">
    <div class="editPostUser">
        <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= $post['name'] ?></h5>
                <small class="text-muted"><?= $post['created_at'] = date('d/m/Y H:i') ?></small>
            </div>
            <input type="hidden" name="authorPost" value="<?=$post['userID']?>">
            <input type="hidden" name="userID" value="<?=$user[0]['id']?>">
            <input type="hidden" name="postId" value="<?=$post['postID']?>">
            <input type="text" name="message" class="inputInvisible" id="" value="<?= $post['message'] ?>">
            <!-- <small class="text-muted">#leroilion</small> -->
            <div class="actions">
            </div>
        </div>
        <?php if (isset($post['image'])) : ?>
            <img class="imgPost" src="data:image/jpeg;base64, <?= base64_encode($post['image']) ?>" />
        <?php endif ?>
        <div class="editFileInput">
            <input type="file" name="imgPost" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            <input type="submit" class="btn btn-primary" value="Send">
        </div>
    </div>
</form>