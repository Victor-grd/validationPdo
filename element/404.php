<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/bootstrap.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<section class="error404">
    <?php
        if($_GET['error'] === "errorLog"){
            $messageError = "Votre nom / prenom entré ne correspond à aucun compte.";
            $messageSecondaire = "Veuillez réessayer ou créer un compte";
        }else {
            $messageError = "je sais pas";
            $messageSecondaire = "";
        }
    ?>

<div class="jumbotron">
  <h1 class="display-3">404</h1>
  <p class="lead"><?=$messageError?></p>
  <hr class="my-4">
  <p><?=$messageSecondaire?></p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="/">Connexion</a>
    <a class="btn btn-primary btn-lg" href="/element/addUser.php">New User</a>
  </p>
</div>

</section>