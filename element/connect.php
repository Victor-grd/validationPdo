<?php 
include_once('./layouts/header.php');
?>
<form method="POST" class="formConnec" action="./db/connexion.php">
<div class="popupConnec card text-white bg-dark mb-3" style="max-width: 20rem;">
  <div class="card-header">Connexion</div>
  <div class="card-body">
    <h4 class="card-title"></h4>
    <div class="form-group">
        <label class="col-form-label" for="inputDefault">Your name</label>
        <input type="text" class="form-control" name="name" placeholder="victor" id="inputDefault">
    </div>
    <div class="form-group">
        <label class="col-form-label" for="inputDefault">Your lastname</label>
        <input type="text" class="form-control" name="lastname" placeholder="grandclement" id="inputDefault">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary">
    </div>
  </div>
</div>
</form>
<?php include_once('./layouts/footer.php')?>