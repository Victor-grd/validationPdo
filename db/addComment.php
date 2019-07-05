<?php

// var_dump($_POST['userId']);
// var_dump($_POST['postID']);
// var_dump($_POST['comment']);die;

$connec = new PDO('mysql:dbname=9gag', 'root', '0000');
$request = $connec->prepare("INSERT INTO `comments` (commentUserId,commentPostId,comment) 
VALUES(:message, :image, :user)");

$request->execute([
  ":message" => $_POST['userId'],
  ":image" => $_POST['postID'],
  ":user" => $_POST['comment'],
]);

header("Location: /index.php?name=" . $_POST['name'] . "&lastname=" . $_POST['lastname']);
