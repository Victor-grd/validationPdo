<?php
$connec = new PDO('mysql:dbname=9gag', 'root', '0000');
$blob  = fopen($_FILES["imgPost"]["tmp_name"], 'rb');
$blob2 = fread($blob, $_FILES["imgPost"]["size"]);
fclose($blob);

$request = $connec->prepare("INSERT INTO `post` (message,image,user) 
VALUES(:message, :image, :user)");

$request->execute([
  ":message" => $_POST['messagePost'],
  ":image" => $blob2,
  ":user" => $_POST['user_id'],
]);

header("Location: /index.php?name=".$_POST['name']."&lastname=".$_POST['lastname']);
