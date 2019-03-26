<?php

class Like{

	public static function addLike($image_id, $user_id){
		$db = Db::getConnection();
		$sql = "INSERT INTO likes (user_id, image_id) 
		VALUES (:user_id, :image_id)";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->bindParam(":image_id", $image_id, PDO::PARAM_INT);
		return $result->execute();
	}

	public static function dissLike($image_id, $user_id){
		$db = Db::getConnection();
		$sql = "DELETE FROM likes WHERE user_id = :user_id AND image_id = :image_id";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->bindParam(":image_id", $image_id, PDO::PARAM_INT);
		return $result->execute();
	}

	public static function checkLike($user_id, $image_id){
		$db = Db::getConnection();
		$sql = "SELECT * FROM likes WHERE user_id = :user_id AND image_id = :image_id";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->bindParam(":image_id", $image_id, PDO::PARAM_INT);
		$result->execute();
		$like = $result->fetch();
		return $like;
	}

	public static function getLikes($image_id){
		$db = Db::getConnection();
		$result = $db->query('SELECT count(image_id) AS count FROM likes WHERE image_id ='. $image_id);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		return $row['count'];
	}
}