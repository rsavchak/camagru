<?php require_once (ROOT."/view/header.php"); ?>

 <script src="/js/drag.js" type="text/javascript"></script>
 <main role="main" class="flex-shrink-0">
 	<div class="container-fluid mt-3">
 		<div class="row justify-content-center">
			<div class="snap col-xs-6 mb-2">
				<div id="video_block" class="">
					<video id="video" width="640" height="480" autoplay="autoplay"></video>
					<div class="file_upload d-none" id="file-input">
						<div>
							<form method="POST">
								<div class="form-group">
	    							<label for="upload">Please, upload photo</label>
	    							<input type="file" accept="image/*" title="No file selected" class="form-control-file" id="upload">
	  							</div>
							</form>
						</div>
					</div>
					<img id="uploaded_img" class="d-none" src="" width="640" height="480">
				</div>
				<div class="icon_block"></div>
				<input id="shot" type="button" name="shot" value="snapShot"/>
			</div>
			<div class="image col-xs-3 mr-2 ml-2 pb-2">
				<img id="curImg" src="" class="canv">
				<canvas style="display:none;" width="640" height="480"></canvas>
				<div id="user_id"><?php echo $_SESSION['user']?>;</div>
				<div id="imgBtns">
					<input id="togal" type="button" name="toGalery" value="To galery" />
				</div>
			</div>
			<div id="rg" class="right_galery col-xs-3">
				<?php foreach ($images as $image) { ?>
					<div id="<?php echo($image['id']); ?>">
						<img class="img_gal" src="<?php echo(substr($image['path_image'], 1));?>">
						<input class="del_img" type="button" value="Delete" onclick="delFromGalery(<?php echo($image['id']); ?>, `<?php echo($image['path_image']); ?>`)">
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="icons">
				<?php foreach ($icons as $icon) { ?>
				<div >
					<img class="img_icon" src="/frames/<?php echo $icon;?>">
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
<?php require_once (ROOT."/view/footer.php"); ?>