<?php require_once (ROOT."/view/header.php"); ?>
<main role="main" class="flex-shrink-0">
<div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
       <?php foreach ($images as $image) { ?>
        <div id="<?=$image['id'];?>" class="col-md-4">
          <div class="card mb-4 border-info shadow-sm">
            <div class="card-body">
              <p class="card-text"><a href="/gallery/image/<?=$image['id'];?>/"><img class="img_gal" src="<?php echo(substr($image['path_image'], 1));?>" id="<?=$image['id'];?>"></a></p>
            </div>
            <div class="card-footer border-info">
              <div class="d-flex justify-content-between align-items-center" style="height: 31px;">
                <div class="btn-group">
                    <?php if(isset($_SESSION['user']) && $image['user']['user_id'] == $_SESSION['user']): ?>
                    <button type="button" onclick="delFromGalery(<?=$image['id'];?>, `<?=$image['path_image']; ?>`); " class="btn btn-sm btn-outline-danger">Delete</button>
                  <?php endif; ?>
                  </div>
                  <small class="text-muted"><?=$image['user']['login'];?></small>
                  <small class="text-muted"><?=$image['likes'];?> likes</small>
                </div>
              </div>
            </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="row justify-content-center"><?php echo $pagination->get(); ?></div>
</div>
</main>
<?php require_once (ROOT."/view/footer.php"); ?>