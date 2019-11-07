<?php require_once (ROOT."/view/header.php"); ?>

<script src="/js/account.js" type="text/javascript"></script>
<main role="main" class="flex-shrink-0">
	<div class="container">
		<div class="row justify-content-center">
			<div class="card border-info mt-3">
				<div class="card-header">Account</div>
				<div class="card-body">
					<p>Login: <?php echo $user['login'];?></p>
					
					<p>Email: <?php echo $user['email'];?></p>
					
					<div>Send mail for comment:
					<select class="form-control" id="select" name="mail" user_id="<?php echo $user['user_id'];?>">
						<option value="1" <?php if($user['mail_com'] == 1) echo 'selected="selected"';?>>On</option>
						<option value="0" <?php if($user['mail_com'] == 0) echo 'selected="selected"';?>>Off</option>
					</select>
					</div>
					<div class="col text-center mt-2">
						<a href="/edit">
							<button class="btn btn-outline-primary mb-2">Edit account</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php require_once (ROOT."/view/footer.php"); ?> 
