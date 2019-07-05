<?php 
require_once(dirname(__DIR__).'/layouts/header.php');
?>
<form enctype="multipart/form-data" method="post" class="formConnec" action="/db/addUser.php">
<div class="popupConnec card text-white bg-dark mb-3" style="max-width: 20rem;">
  <div class="card-header">New User</div>
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
        <label class="col-form-label" for="inputDefault">Description</label>
        <input type="text" class="form-control" name="description" placeholder="patatalo" id="inputDefault">
    </div>
    <div class="form-group actionFormMessage">
      <input type="file" name="imgProfil" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
      <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" name="admin" id="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">Admin</label>
      </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary">
    </div>
  </div>
</div>
</form>
<?php require_once(dirname(__DIR__).'/layouts/footer.php');?>