<?php require_once (ROOT."/view/header.php"); ?>
 <script src="/js/img.js" type="text/javascript"></script>
<center>
	<div class="content">
		<img class="photo" src="<?php echo(substr($image['path_image'], 1));?>">
		<div class="likes">
		<?php if ($like) {?>
			<div class="like liked" image_id="<?php echo($image['id']);?>" user_id="<?php echo $_SESSION['user'];?>">
			
		<?php } else {?>
			<div class="like unliked" image_id="<?php echo($image['id']);?>" user_id="<?php echo $_SESSION['user'];?>">
		<?php } ?>
			</div>
			<div class="likes_quantity">
				<h3><?php if($likes_quantity > 0){echo $likes_quantity;}?></h3>
			</div>
		</div>
		<div id="comBlock" class="comment">
			<?php foreach ($comments as $comment): ?>
			<div id="<?php echo $comment['id']; ?>com" class="commentBox">
				<?php if ($user_image['user_id'] == $_SESSION['user'] || $comment['user_id'] == $_SESSION['user']){?>
				<div id="delete_comment" onclick="delComment(this)">x</div>
			<?php } ?>
				<div class="text_comment"><?php echo $comment['comment']; ?></div>
				<div class="date_comment"><?php echo $comment['date']; ?></div>

				<hr>
			</div>
			<?php endforeach ?>
			</div>
			<form class="comment_form" method="post">
				<textarea id="comment" placeholder="Write yoour comment"></textarea>
				<input  class="send" type="button" name="submit" value="Send Comment" onclick="addComment(<?php echo $_SESSION['user'];?>, <?php echo($image['id']);?>)">
			</form>
		
	</div>
</center> 
<?php require_once (ROOT."/view/footer.php"); ?>