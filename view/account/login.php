<?php require_once (ROOT."/view/header.php"); ?>
	<center>
		<?php if(isset($errors) && is_array($errors)):?>
				<ul>
					<?php foreach($errors as $error): ?>
						<li> - <?php echo "$error";?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
	</center>
		<div class="reg_form">
		<form method="post">
			<center><h1>Log in</h1></center>
			<div class="group">
				<label>Login:</label>
				<input type="text" name="login"/>
			</div>
			<div class="group">
				<label>Password:</label>
				<input type="password" name="passwd"/>
			</div>
			<center><input class="submit" type="submit" name="submit" value="Log in"/>
			<br/>
			<a href="/reset/">I forgot my password</a>
			</center>
		</form>
	</div>
	
<?php require_once (ROOT."/view/footer.php"); ?>