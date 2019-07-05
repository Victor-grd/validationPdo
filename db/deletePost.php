<?php
// var_dump($_POST['postId']);
// var_dump($_POST['lastname']);
// var_dump($_POST['name']);die;
$connec = new PDO('mysql:dbname=9gag', 'root', '0000');
$delete = $connec->prepare("DELETE FROM post WHERE id =  :id");
$delete->execute([
    ":id" => $_POST['postId'],
]);

header("Location: /element/profil.php?name=" . $_POST['name'] . "&lastname=" . $_POST['lastname']);
