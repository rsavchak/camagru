<?php
class Db {
	public static function getConnection(){
		$paramsPath = ROOT . '/config/database.php';
		include($paramsPath);
		try
		{
			$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
		}
		catch (PDOException $e){
			echo "Connection failed: " .$e->getMessage();
			return false;
		}
		
	}
}