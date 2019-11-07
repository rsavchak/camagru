<?php require_once (ROOT."/view/header.php"); ?>
	<div class="container">
		<?php if(isset($errors) && is_array($errors)):?>
			<ul>
				<?php foreach($errors as $error): ?>
					<div class="alert alert-danger mt-1" role="alert">
						 <li> - <?php echo "$error";?></li>
					</div>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php if(isset($res)) :?>
			<div class="alert alert-success mt-1" role="alert">
				<?= $res;?>
			</div>
		<?php endif; ?>
	</div>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5 mt-3 mb-3">
				<div class="card border-info">
					<div class="card-header">Edit account</div>
					<div class="card-body">
						<form method="POST" >
							<div class="form-group">
								<label for="login">Login:</label>
								<input class="form-control" id="login" type="text" name="login" value="<?php echo $user['login'];?>" required/>
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input class="form-control" id="email" type="email" name="email" value="<?php echo $user['email'];?>" required/>
							</div>
							<div class="form-group">
								<label for="pass">Old Password:</label>
								<input class="form-control" id="pass" type="password" name="old_passwd" required/>
							</div>
							<div class="form-group">
								<label for="new_pass">New Password:</label>
								<input class="form-control" id="new_pass" type="password" name="new_passwd" required/>
							</div>
							<div class="col text-center">
								<button type="submit" class="btn btn-outline-primary mb-2" name="submit" value="Edit">Edit account</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once (ROOT."/view/footer.php"); ?>