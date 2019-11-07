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
				<div class="col-lg-4 mt-3">
					<div class="card border-info">
						<div class="card-header">Forgot your password?</div>
						<div class="card-body">
							<form method="post">
								<div class="form-group">
									<label for="email">Email:</label>
									<input  class="form-control" id="email" type="email" name="email" placeholder="email" required>
								</div>
								<div class="col text-center">
									<button type="submit" class="btn btn-outline-primary mb-2" name="submit" value="RESET PASSWORD">Reset password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>		
		</div>
<?php require_once (ROOT."/view/footer.php"); ?>