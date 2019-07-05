<?php
// require_once('/layouts/header.php');
require_once(dirname(__DIR__) . '/layouts/header.php');
// $allPost = $connec->prepare('SELECT * FROM post JOIN user ON post.user=user.id WHERE post.user='.$user[0]['id']);
$allPost = $connec->prepare('SELECT
 post.id AS postID, message, image, created_at, user,
 user.id AS userID, name, lastname, imgProfil, description
 FROM post 
 JOIN user ON post.user=user.id 
 WHERE post.user=' . $user[0]['id']);
$allPost->execute();
$allPost = $allPost->fetchAll();
?>
<section class="profilePage">
    <div class="profileUser">
        <?php // var_dump($user[0]['imgProfil'])
        ?>
        <?php
        if ($user[0]['imgProfil'] !== "") {
            echo ('<img class="imageUserProfile" src="data:image/jpeg;base64,' . base64_encode($user[0]['imgProfil']) . '"/>');
        };
        ?>
        <form enctype="multipart/form-data" class="jumbotron profileUserInfo" action="/db/editProfil.php" method="post">
                <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
                <input type="text" name="newName" class="display-2 inputInvisible" value="<?= $user[0]['name']?>">
                <input type="text" name="newLastname" class="display-4 inputInvisible" value="<?= $user[0]['lastname'] ?>">
            <hr class="my-4">
            <input class="lead inputInvisible" name="description" value="<?= $user[0]['description'] ?>">
            <div class="lead formPictureProfile">
                <div class="form-group">
                    <input type="file" name="imgProfil" class="btn" id="exampleInputFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">si tu ne sélectionnes pas d'image avant de save, ta photo de profil sera supprimé</small>
                </div>
                <input type="submit" class="btn btn-primary btn-lg" value="Save">
            </div> 
        </form>
    </div>
    <div class="postsUser">

        <?php foreach ($allPost as $key => $post) : ?>
            <div class="postUser">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $post['name'] ?></h5>
                        <small class="text-muted"><?= $post['created_at'] = date('d/m/Y H:i') ?></small>
                    </div>
                    <p class="mb-1"><?= $post['message'] ?></p>
                    <!-- <small class="text-muted">#leroilion</small> -->
                    <div class="actions">

                        <form method="post" action="/element/editPost.php?name=<?=$user[0]['name']?>&lastname=<?=$user[0]['lastname']?>">
                            <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
                            <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">
                            <input type="hidden" name="postId" value="<?= $post['postID'] ?>">
                            <input type="submit" class="btn btn-primary action" value="Edit">
                        </form>

                        <form action="/db/deletePost.php" method="post">
                            <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
                            <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">
                            <input type="hidden" name="postId" value="<?= $post['postID'] ?>">
                            <input type="submit" class="btn btn-primary action" value="Delete">
                        </form>
                    </div>
                </div>
                <?php if ($post['image'] !== ''): ?>
                    <img class="imgPost" src="data:image/jpeg;base64, <?= base64_encode($post['image']) ?>" />
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</section>