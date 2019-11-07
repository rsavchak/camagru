<?php

class AccountController
{

	public function actionIndex()
	{
		if (empty($_SESSION['user']))
			header("Location: /login/");
		$user = Account::getUser($_SESSION['user']);
		require_once (ROOT."/view/account/account.php");
		
		return true;
	}

	public function actionChange()
	{
		if (isset($_POST))
		{
			$user_id = $_POST['user_id'];
			$value = $_POST['value'];
			$res = Account::changeMail($user_id, $value);
			if($res)
				echo "ok";
		}
		return true;
	}

	public function actionLogin($confirm = ""){
		if(isset($_SESSION['user']))
			header("Location: /cam/");
		$login = "";
		$passwd = "";
		if (isset($_POST['submit']))
		{
			$login = $_POST['login'];
			$passwd = $_POST['passwd'];
			$errors = false;
			if(!$login)
				$errors[] = "You dont fill login field";
			if (!$passwd)
				$errors[] = "You dont fill password field";
			if ($errors == false){
				$passwd = hash('whirlpool', $passwd);
				$user = Account::getUserId($login, $passwd);
				if ($user['user_id'] && $user['status'] != 1)
					$errors[] = "Please confirm your email";
				else if($user['user_id'] != false){
					Account::auth($user);
					header("Location: /cam/");

				}
				else
					$errors[] = "Bad login or password";
			}
		}
		require_once (ROOT."/view/account/login.php");
		return true;
	}

	public function actionLogout(){
		if ($_SESSION['user'])
			unset($_SESSION['user']);
		header("Location: /");
		return true;
	}

	public function actionRegister(){
		$login = "";
		$passwd = "";
		$email = "";
		if (isset($_POST['submit'])){
			$login = $_POST['login'];
			$passwd = $_POST['passwd'];
			$repasswd = $_POST['repasswd'];
			$email = $_POST['email'];
			$errors = false;
			if (!Account::checkLogin($login))
			 	$errors[] = "Bad login!";
			if (!Account::checkEmail($email))
			 	$errors[] = "Bad email";
			if (!Account::checkPassword($passwd, $repasswd))
			 	$errors[] = "Bad password!";
			if ($errors == false){
				$passwd = hash('whirlpool', $passwd);
				$token = Account::register($login, $passwd, $email);
				if ($token)
				{
					if (Mail::sendMail($email, $token))
					{	
						require_once (ROOT."/view/account/confirm.php");
						return true;
					}
				}
			}
		}
		require_once (ROOT."/view/account/register.php");
		return true;
	}


	public function actionEdit(){
		if (empty($_SESSION['user']))
			header("Location: /login/");
		if (isset($_POST['submit']))
		{
			$login = $_POST['login'];
			$email = $_POST['email'];
			$old_password = $_POST['old_passwd'];
			$new_password = $_POST['new_passwd'];
			$errors = false;
			if (Account::checkPassword($new_password, $new_password))
			{
				$account = Account::getUserId(Account::getUser($_SESSION['user'])['login'], hash('whirlpool', $old_password));
				if (isset($account['user_id']))
				{	
					$new_password = hash('whirlpool', $new_password);
					$res = Account::editUser($login, $email, $new_password, $_SESSION['user']);
					if ($res)
						$res = "Account was edited.";
					else
						$res = "Try again.";
				}
				else
					$errors[] = "Incorrect password";
			}
			else
				$errors[] = "Bad password";
		}
		$user = Account::getUser($_SESSION['user']);
		require_once (ROOT."/view/account/edit.php");
		return true;
	}

	public function actionConfirm($token){
		if ($token)
		{
			if (Account::confirmEmail($token))
			{
				header("Location: /login/");
				return true;
			}
			echo"ERROR 404";
			header("HTTP/1.0 404 Not Found");
		
		}
		return true;
	}

	public function actionReset(){
		$email = "";
		if (isset($_POST['submit'])){
			$email = $_POST['email'];
			$errors = false;
			if($email)
			{
				if ($user_id = Account::getUserByEmail($email))
				{
					$pass = Account::generatePass();
					$mail = Mail::sendPass($email, $pass);
					$pass = hash('whirlpool', $pass);
					if ($res = Account::changePass($user_id, $pass))
						$res = "We sent you mail with new password";
				}
				else
					$errors[] = "This email is not registered";
			}
			else
				$errors[] = "You dont fill email field";
		}
		require_once (ROOT."/view/account/reset_pass.php");
		return true;
	}
}