<?php require_once (ROOT."/view/header.php"); ?>
<script src="/js/account.js" type="text/javascript"></script>

	<center>
			<?php if(isset($errors) && is_array($errors)):?>
				<ul>
					<?php foreach($errors as $error): ?>
						<li> - <?php echo "$error";?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
	</center>
		<div class = "reg_form">
		<form method="post" id="form">
			<center><h1>Sign up</h1></center>
			<div class="group">
				<label>Login:</label>
				<input type="text" name="login"/>
			</div>
			<div class="group">
				<label>Email:</label>
				<input type="text" name="email"/>
			</div>
			<div class="group">
				<label>Password:</label>
				<input type="password" name="passwd"/>
			</div>
			<div class="group">
				<label>Agree password:</label>
				<input type="password" name="repasswd"/>
			</div>
			<center><input class="submit" type="submit"  name="submit" value="Register" /></center>
		</form>
			
	</div>
<?php require_once (ROOT."/view/footer.php"); ?>