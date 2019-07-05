
<?php
    $connec = new PDO('mysql:dbname=9gag','root','0000');
    $stm = $connec->prepare('SELECT * FROM `user` WHERE `name`=:name AND `lastname`=:lastname');
    $stm->execute([
        ':name' => $_POST['name'],
        ':lastname' => $_POST['lastname']
    ]);    
    $res = $stm->fetchAll();
    if (count($res) > 0) {
        header('Location: /index.php?name='.$_POST['name'].'&lastname='.$_POST['lastname']);die;
    }
    else {
        header('Location: /element/404.php?error=errorLog');die;
    }
  