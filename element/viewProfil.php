<?php
// require_once('/layouts/header.php');
require_once(dirname(__DIR__) . '/layouts/header.php');
// $allPost = $connec->prepare('SELECT * FROM post JOIN user ON post.user=user.id WHERE post.user='.$user[0]['id']);

// $allPost = $connec->prepare('SELECT
//  post.id AS postID, message, image, created_at, user,
//  user.id AS userID, name, lastname, imgProfil, description
//  FROM post 
//  JOIN user ON post.user=user.id 
//  WHERE post.user=' . $user[0]['id']);
// $allPost->execute();
// $allPost = $allPost->fetchAll();

$userProfil = $connec->prepare('SELECT * FROM user WHERE user.name= :userView');
$userProfil->execute([
    ':userView' => $_GET['view']
]);
$userProfil = $userProfil->fetchAll();

$allPost = $connec->prepare('SELECT
 post.id AS postID, message, image, created_at, user,
 user.id AS userID, name, lastname, imgProfil, description
 FROM post 
 JOIN user ON post.user=user.id 
 WHERE post.user=' . $userProfil[0]['id']);
$allPost->execute();
$allPost = $allPost->fetchAll();

?>
<section class="profilePage">
    <div class="profileUser">
        <?php // var_dump($user[0]['imgProfil'])
        ?>
        <?php
        if ($userProfil[0]['imgProfil'] !== '') {
            echo ('<img class="imageUserProfile" src="data:image/jpeg;base64,' . base64_encode($userProfil[0]['imgProfil']) . '"/>');
        };
        ?>
        <div class="jumbotron profileUserInfo">
            <h1 class="display-3"><?= $userProfil[0]['name'] . "  " . $userProfil[0]['lastname'] ?></h1>
            <hr class="my-4">
            <p class="lead"><?= $userProfil[0]['description'] ?></p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
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
                    <?php if ($user[0]['role'] === 'admin'): ?>
                    <div class="actions">

                        <form method="post" action="/element/editPost.php?name=<?=$user[0]['name']?>&lastname=<?=$user[0]['lastname']?>">
                            <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
                            <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">
                            <input type="hidden" name="postId" value="<?= $post['postID'] ?>">
                            <input type="submit" class="btn btn-warning action" value="Edit">
                        </form>

                        <form action="/db/deletePost.php" method="post">
                            <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
                            <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">
                            <input type="hidden" name="postId" value="<?= $post['postID'] ?>">
                            <input type="submit" class="btn btn-warning action" value="Delete">
                        </form>
                    </div>
                    <?php endif ?>
                </div>
                <?php if ($post['image'] !== "") : ?>
                    <img class="imgPost" src="data:image/jpeg;base64, <?= base64_encode($post['image']) ?>" />
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</section>