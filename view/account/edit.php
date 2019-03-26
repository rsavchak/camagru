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
	</center>
		<br/>
		<div class = "reg_form">
		<form method="post">
			<center><h1>Edit account</h1></center>
			<div class="group">
				<label>Login:</label>
				<input type="text" name="login" value="<?php echo $user['login'];?>"/>
			</div>
			<div class="group">
				<label>Email:</label>
				<input type="text" name="email" value="<?php echo $user['email'];?>"/>
			</div>
			<div class="group">
				<label>Old Password:</label>
				<input type="password" name="old_passwd"/>
			</div>
			<div class="group">
				<label>New Password:</label>
				<input type="password" name="new_passwd"/>
			</div>
			<center><input class="submit" type="submit" name="submit" value="Edit" /></center>
		</form>
	</div>
<?php require_once (ROOT."/view/footer.php"); ?>