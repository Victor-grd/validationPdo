<?php
// var_dump($_POST['name'],$_POST['lastname']);die;
if ($_POST["admin"] === 'on') {
  $role = 'admin';
}else {
  $role = 'user';
}

$connec = new PDO('mysql:dbname=9gag', 'root', '0000');
$blob  = fopen($_FILES["imgProfil"]["tmp_name"], 'rb');
$blob2 = fread($blob, $_FILES["imgProfil"]["size"]);
fclose($blob);


$request = $connec->prepare("INSERT INTO user (name, lastname, imgProfil, description, role)
VALUES (:name, :lastname, :imgProfil, :description, :role);");
$request->execute([
  ":name" => $_POST['name'],
  ":lastname" => $_POST['lastname'],
  ":imgProfil" => $blob2,
  ":description" => $_POST['description'],
  ":role" => $role,
]);
header('Location: /index.php');

  