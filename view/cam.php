<?php require_once (ROOT."/view/header.php"); ?>
 <script src="/js/cams.js" type="text/javascript"></script>
 <script src="/js/drag.js" type="text/javascript"></script>
 	
<center><div class="center">
	<div class="snap">
		<div class="video_block"><video id="video" width="640" height="480" autoplay="autoplay"></video></div>
		<div class="icon_block"></div>
		<input id="shot" type="button" name="shot" value="snapShot"/>
	</div>
	<div class="image">
		<img id="curImg" src="" class="canv">
		<canvas style="display:none;" width="640" height="480"></canvas>
		<div id="user_id"><?php echo $_SESSION['user']?>;</div>
		<div id="imgBtns">
			<input id="togal" type="button" name="toGalery" value="To galery" />
		</div>
	</div>
	<div id="rg" class="right_galery">
		<?php foreach ($images as $image) { ?>
			<div id="<?php echo($image['id']); ?>">
				<img class="img_gal" src="<?php echo(substr($image['path_image'], 1));?>">
				<input class="del_img" type="button" value="Delete" onclick="delFromGalery(<?php echo($image['id']); ?>, `<?php echo($image['path_image']); ?>`)">
			</div>
		<?php } ?>
	</div>
</div></center>
<center><div class="icons">
	<?php foreach ($icons as $icon) { ?>
			<div >
				<img class="img_icon" src="/frames/<?php echo $icon;?>">
			</div>
		<?php } ?>

</div></center>
<?php require_once (ROOT."/view/footer.php"); ?>