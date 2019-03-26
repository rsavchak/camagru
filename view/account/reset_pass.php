<?php require_once (ROOT."/view/header.php"); ?>
	<center>
		<?php if(isset($errors) && is_array($errors)):?>
				<ul>
					<?php foreach($errors as $error): ?>
						<li> - <?php echo "$error";?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<?php if(isset($res)){
					echo "$res";
				}?>
				<br/>
		<div>
		<h1>Forgot your password?</h1>
		<form method="post">
			<input type="text" name="email" placeholder="email">
			<br/>
			<input class="submit" type="submit" name="submit" value="RESET PASSWORD">
		</form>
	</div></center>
<?php require_once (ROOT."/view/footer.php"); ?>