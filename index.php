<?php 
include_once('./layouts/header.php');

if(isset($_GET['name']) && $_GET['lastname']) {
    $userLog = true;
}else {
    $userLog = false;
}

if ($userLog === false) {
    include_once('./element/connect.php');
}else{
    include_once('./element/home.php');
}

include_once('./layouts/footer.php')?>