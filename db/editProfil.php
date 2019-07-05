<?php
$connec = new PDO('mysql:dbname=9gag', 'root', '0000');

if ($_FILES['imgProfil']['size'] !== '0') {
  $blob  = fopen($_FILES["imgProfil"]["tmp_name"], 'rb');
  $blob2 = fread($blob, $_FILES["imgProfil"]["size"]);
  fclose($blob);
}

// var_dump($_POST['name']);
// var_dump($_POST['newName']);
// var_dump($_POST['newLastname']);
// var_dump($_POST['description']);die;

$request = $connec->prepare("UPDATE `user`
SET name = :newName,
lastname = :newLastname,
imgProfil = :image,
description = :description
WHERE user.name = :name");

$request->execute([
  ":name" => $_POST['name'],
  ":newName" => $_POST['newName'],
  ":newLastname" => $_POST['newLastname'],
  ":description" => $_POST['description'],
  ":image" => $blob2,
]);

header("Location: /element/profil.php?name=" . $_POST['newName'] . "&lastname=" . $_POST['newLastname']);
