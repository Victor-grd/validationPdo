<form enctype="multipart/form-data" class="formPost" action="/db/addPost.php" method="post">
  <input type="hidden" name="user_id" value="<?= $user[0]['id'] ?>">
  <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
  <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">

  <div class="form-group textareaMessage">
    <textarea class="form-control" name="messagePost" id="exampleTextarea" rows="3" style="max-height: 75px;"></textarea>
  </div>

  <div class="form-group actionFormMessage">
    <input type="file" name="imgPost" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
    <input type="submit" class="btn btn-primary" value="Send">
  </div>
</form>


<section class="posts">
  <?php foreach ($allPost as $key => $post) : ?>
    <div class="publication">
      <div class="post">
        <a href="/element/viewProfil.php?name=<?=$user[0]['name']?>&lastname=<?=$user[0]['lastname']?>&view=<?=$post['name']?>">
          <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><?= $post['name'] ?></h5>
              <small class="text-muted"><?= $post['created_at'] ?></small>
            </div>
            <p class="mb-1"><?= $post['message'] ?></p>
            <!-- <small class="text-muted">#leroilion</small> -->
          </div>
        </a>
        <?php if ($post['image'] !== '') : ?>
          <img class="imgPost" src="data:image/jpeg;base64,<?= base64_encode($post['image']) ?>" />
        <?php endif ?>
      </div>
      <div class="comments">
        <div class="commentsList">
          <?php foreach ($comments as $key => $comment) : ?>
            <?php if ($comment['commentPostId'] === $post['postID']) : ?>
              <p class="commentText"><span><?= $comment['name'] ?> : </span><span class="text-muted"><?= $comment['comment'] ?></span></p>
            <?php endif ?>
          <?php endforeach ?>
        </div>
        <form class="commentSend" action="/db/addComment.php" method="post">
          <input type="hidden" name="userId" value="<?= $user[0]['id'] ?>">
          <input type="hidden" name="name" value="<?= $user[0]['name'] ?>">
          <input type="hidden" name="lastname" value="<?= $user[0]['lastname'] ?>">
          <input type="hidden" name="postID" value="<?= $post['postID'] ?>">
          <input type="text" class="form-commentInput commentInput" name="comment">
          <input type="submit" class="btn btn-primary commentSubmit" name="commentSubmit" value="Send">
        </form>
      </div>
    </div>
  <?php endforeach ?>
</section>