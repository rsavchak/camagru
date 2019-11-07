<?php require_once (ROOT."/view/header.php"); ?>
<script src="/js/account.js" type="text/javascript"></script>

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
		<div class="col-lg-4 mt-3 mb-3">
			<div class="card border-info">
				<div class="card-header">Sign up</div>
				<div class="card-body">
					<form method="post" id="form">
						<div class="form-group">
							<label for="login">Login:</label>
							<input class="form-control" id="login" type="text" name="login" required min="3" max="20"/>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input class="form-control" id="email" type="email" name="email" required />
						</div>
						<div class="form-group">
							<label for="pass">Password:</label>
							<input class="form-control" id="pass" type="password" name="passwd" required />
						</div>
						<div class="form-group">
							<label for="agree">Agree password:</label>
							<input id="agree" class="form-control" type="password" name="repasswd" required/>
						</div>
						<div class="col text-center mb-2">
							<button type="submit" class="btn btn-outline-primary mb-2" name="submit" value="Register">Register</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>			
<?php require_once (ROOT."/view/footer.php"); ?>