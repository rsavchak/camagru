<?php

class Account{
	public static function register($login, $pass, $email){
		$db = Db::getConnection();
		$token = bin2hex(random_bytes(20));

		$sql = "INSERT INTO users (login, password, email, token)
		 VALUES (:login, :password, :email, :token)";
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', $pass, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':token', $token, PDO::PARAM_STR);
		if ($result->execute())
			return $token;
	}

	public static function getUserId($login, $pass){
		$db = Db::getConnection();
		$sql = "SELECT * FROM users WHERE login = :login AND password = :password";
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', $pass, PDO::PARAM_STR);
		$result->execute();
		$row = $result->fetch();
		$user['user_id'] = $row['user_id'];
		$user['login'] = $row['login'];
		$user['email'] = $row['email'];
		$user['status'] = $row['status']; 
		return $user;
	}

	public static function getUser($user_id){
		$db = Db::getConnection();
		$sql = "SELECT * FROM users WHERE user_id = :user_id";
		$result = $db->prepare($sql);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->execute();
		$row = $result->fetch();
		$user['user_id'] = $row['user_id'];
		$user['login'] = $row['login'];
		$user['email'] = $row['email'];
		$user['password'] = $row['password'];
		$user['mail_com'] = $row['mail_com'];
		return $user;
	}

	public static function getUserByEmail($email){
		$db = Db::getConnection();
		$sql = "SELECT user_id FROM users WHERE email = :email";
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		$row = $result->fetch();
		$user_id = $row['user_id'];
		return $user_id;
	}

	public static function confirmEmail(string $token){
		$db = Db::getConnection();
		$sql = "SELECT * FROM users WHERE token = :token";
		$result = $db->prepare($sql);
		$result->bindParam(':token', $token, PDO::PARAM_STR);
		$result->execute();
		$row = $result->fetch();
		if ($user_id = $row['user_id'])
		{
			$sql = "UPDATE users SET token = :token, status = :status WHERE user_id = :user_id";
			$result = $db->prepare($sql);
			$result->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$result->bindValue(':token', NULL, PDO::PARAM_STR);
			$result->bindValue(':status', 1, PDO::PARAM_INT);
			if ($result->execute())
				return true;
		}
		return false;

	}

	public static function auth($user){
		$_SESSION['user'] = $user['user_id'];
		$_SESSION['login'] = $user['login'];
		$_SESSION['comment'] = $user['mail_com'];
	}

	public static function editUser($login, $email, $password, $user_id){
		$db = Db::getConnection();
		$sql = "UPDATE users SET login = :login, email = :email, password = :password WHERE user_id = :user_id";
		$result = $db->prepare($sql);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();

		return $result;
	}

	public static function checkLogin($login)
	{
		if(strlen($login) >= 4)
		{
			$db = Db::getConnection();
			$sql = "SELECT user_id FROM users WHERE login = :login";
			$result = $db->prepare($sql);
			$result->bindParam(':login', $login, PDO::PARAM_STR);
			$result->execute();
			$row = $result->fetch();
			if (!$row)
				return true; 
		}
		return false;
	}

	public static function checkPassword($passwd, $repasswd){
		if ($passwd === $repasswd)
		{
			if (preg_match('/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $passwd))
				return true;
		}
		return false;
	}

	public static function checkEmail($email)
	{
		if ($email)
		{
			if (preg_match('/^.*?@.*?\..*?$/', $email))
			{
				$db = Db::getConnection();
				$sql = "SELECT user_id FROM users WHERE email = :email";
				$result = $db->prepare($sql);
				$result->bindParam(':email', $email, PDO::PARAM_STR);
				$result->execute();
				$row = $result->fetch();
				if (!$row)
					return true; 
			}
		}
		return false;
	}



	public static function generatePass(){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-+=*%:?;@|!.,<>";
		$pass = "";
		for($i = 8; $i > 0; $i--){
			$pass .= $chars[rand(0,strlen($chars)-1)];
		}
		if (isset($pass))
			return $pass;
	}

	public static function changePass($user_id, $pass){
		$db = Db::getConnection();
		$sql = "UPDATE users SET password = :password WHERE user_id = :user_id";
		$result = $db->prepare($sql);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->bindParam(':password', $pass, PDO::PARAM_STR);
		$result->execute();

		return $result;
	}

	public static function getUserByImage($image_id)
	{
		$db = Db::getConnection();
		$sql = "SELECT * FROM users INNER JOIN images ON users.user_id = images.user_id WHERE images.id = :image_id";
		$result = $db->prepare($sql);
		$result->bindParam(':image_id', $image_id, PDO::PARAM_INT);
		$result->execute();
		$row = $result->fetch();
		$user['user_id'] = $row['user_id'];
		$user['login'] = $row['login'];
		$user['email'] = $row['email'];
		$user['mail_com'] = $row['mail_com'];
		return $user;
	}



	public static function changeMail($user_id, $mail_com){
		$db = Db::getConnection();
		$sql = "UPDATE users SET mail_com = :mail_com WHERE user_id = :user_id";
		$result = $db->prepare($sql);
		$result->bindParam(':mail_com', $mail_com, PDO::PARAM_INT);
		$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$result->execute();
		return $result;
	}
}