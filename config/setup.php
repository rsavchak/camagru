<?php
require_once(ROOT . "/components/Db.php");
class Setup{
	public static function create(){
		$db = Db::getConnection();

		$sql = "CREATE TABLE IF NOT EXISTS users 
		(user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		login VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		token VARCHAR(255) UNIQUE,
		status INT DEFAULT 0,
		mail_com INT DEFAULT 1);";

		$sql .= "CREATE TABLE IF NOT EXISTS images 
		(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		user_id INT NOT NULL,
		path_image VARCHAR(255) NOT NULL,
		image TEXT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE);";

		$sql .= "CREATE TABLE IF NOT EXISTS comments 
		(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		user_id INT NOT NULL,
		image_id INT NOT NULL,
		date VARCHAR(255) NOT NULL,
		comment TEXT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
		FOREIGN KEY (image_id) REFERENCES images (id) ON DELETE CASCADE);";

		$sql .= "CREATE TABLE IF NOT EXISTS likes 
		(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		user_id INT NOT NULL,
		image_id INT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
		FOREIGN KEY (image_id) REFERENCES images (id) ON DELETE CASCADE);";

		$admin_password = "12345678";
		$admin_password = hash('whirlpool', $admin_password);
		$sql .= " INSERT INTO users (user_id, login, password, email, status) VALUES (1, 'admin', '" . $admin_password . "', 'admin@ukr.net', 1);";
		$result = $db->exec($sql);
		return $result;
	}
}