<?php require_once (ROOT."/view/header.php"); ?>
 <script src="/js/account.js" type="text/javascript"></script>

	<center>
		<div>
			Login: <?php echo $user['login'];?>
			<br/>
			Email: <?php echo $user['email'];?>
			<br/>
			Send mail for comment:
			<select id="select" name="mail" user_id="<?php echo $user['user_id'];?>">
				<option value="1" <?php if($user['mail_com'] == 1) echo 'selected="selected"';?>>On</option>
				<option value="0" <?php if($user['mail_com'] == 0) echo 'selected="selected"';?>>Off</option>
			</select>
			<br/>
			<a href="/edit">Edit</a>
		</div>
	</center>

<?php require_once (ROOT."/view/footer.php"); ?>