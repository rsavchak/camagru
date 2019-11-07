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
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 mt-3">
				<div class="card border-info">
					<div class="card-header">Log in</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label for="login">Login:</label>
								<input class="form-control" if="login" type="text" name="login" required />
							</div>
							<div class="form-group">
								<label for="pass">Password:</label>
								<input class="form-control" id="pass" type="password" name="passwd" required />
							</div>
							<div class="col text-center mb-2">
								<button type="submit" class="btn btn-outline-primary mb-2" name="submit" value="Log in">Log in</button>
							</div>
							<div class="col text-center">
								<a href="/reset/">I forgot my password</a>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php require_once (ROOT."/view/footer.php"); ?>