<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/bootstrap.css">
    <link rel="stylesheet" href="/style/main.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_GET['name']) && $_GET['lastname']) {
        $connec = new PDO('mysql:dbname=9gag;charset=UTF8', 'root', '0000');

        $user = $connec->prepare('SELECT * FROM `user` WHERE `name`=:name AND `lastname`=:lastname');
        $user->execute([
            ':name' => $_GET['name'],
            ':lastname' => $_GET['lastname']
        ]);
        $user = $user->fetchAll();

        $allPost = $connec->prepare('SELECT
    post.id AS postID, message, image, created_at, user,
    user.id AS userID, name, lastname, imgProfil, description
    FROM post 
    JOIN user ON post.user=user.id
    ORDER BY created_at DESC');
        // LEFT JOIN comments ON post.id=commentPostId
        $allPost->execute();
        $allPost = $allPost->fetchAll();

        $comments = $connec->prepare('SELECT 
    comments.id AS commentId, commentUserId, commentPostId, comment,
    user.id AS userID, name, lastname, imgProfil, description
    FROM comments
    JOIN user ON commentUserId=user.id
    ORDER BY commentId ASC');
        $comments->execute();
        $comments = $comments->fetchAll();
    }
    ?>
    <header>
        <?php if (isset($user[0])) : ?>
            <div class="header">
                <div class="profileHeader">
                    <h4><?= $user[0]['lastname'] ?> <?= $user[0]['name'] ?></h4>
                </div>
                <div class="actionHeader">
                    <div class="profil"></div>
                    <?php if($user[0]['role'] === 'admin'): ?>
                    <a class="btn btn-warning" href="#">User</a>
                    <?php endif ?>
                    <a class="btn btn-primary" href="/index.php?name=<?= $user[0]['name'] ?>&lastname=<?= $user[0]['lastname'] ?>">Home</a>
                    <a class="btn btn-primary" href="/element/profil.php?name=<?= $user[0]['name'] ?>&lastname=<?= $user[0]['lastname'] ?>">Profile</a>
                    <a class="btn btn-primary" href="/db/deconnect.php">Deconnexion</a>
                </div>
            </div>
        <?php else : ?>
            <div class="header">
                <div class="profileHeader">

                </div>
                <div class="action">
                    <div class="profil"></div>
                    <a class="btn btn-primary" href="/">Connexion</a>
                    <a class="btn btn-primary" href="/element/addUser.php">New User</a>
                </div>
            </div>
        <?php endif ?>
    </header>