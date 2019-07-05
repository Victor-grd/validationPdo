<?php
$connec = new PDO('mysql:dbname=9gag', 'root', '0000');

$authorPost = $connec->prepare('SELECT * FROM `user` WHERE `id`=:id');
$authorPost->execute([
    ':id' => $_POST['authorPost'],
]);
$authorPost = $authorPost->fetch();

$user = $connec->prepare('SELECT * FROM `user` WHERE `id`=:id');
$user->execute([
    ':id' => $_POST['userID'],
]);
$user = $user->fetch();

$blob  = fopen($_FILES["imgPost"]["tmp_name"], 'rb');
$blob2 = fread($blob, $_FILES["imgPost"]["size"]);
fclose($blob);

// var_dump($_POST['authorPost']);die;
// var_dump($_POST['message']);
// var_dump($blob2);die;

$request = $connec->prepare("UPDATE `post`
SET message = :message,
image = :image
WHERE post.id = :id");

$request->execute([
  ":message" => $_POST['message'],
  ":image" => $blob2,
  ":id" => $_POST['postId'],

]);

if($user['role'] === 'admin'){
  header("Location: /element/viewProfil.php?name=".$user['name']."&lastname=".$user['lastname'].'&view='. $authorPost['name']);
}else{
  header("Location: /element/profil.php?name=".$user['name']."&lastname=".$user['lastname']);
}
