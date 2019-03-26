<?php require_once (ROOT."/view/header.php"); ?>
	<center><div class="image_box">
		
			<?php foreach ($images as $image) { ?>
				<div class="picture">
						<a href="/gallery/image/<?php echo($image['id']);?>/"><img class="img_gal" src="<?php echo(substr($image['path_image'], 1));?>" id="<?php echo($image['id']);?>"></a>
				</div>
				<?php } ?>
		
	</div></center>
	<center><?php echo $pagination->get(); ?></center>

<?php require_once (ROOT."/view/footer.php"); ?>