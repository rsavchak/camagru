<?php

class Comment{

		public static function addComment(int $image_id, int $user_id, string $comment)
	{
		$db = Db::getConnection();
		$date = date('M d, Y, H:i');
		$sql = "INSERT INTO comments (user_id, image_id, comment, date) 
		VALUES (:user_id, :image_id, :comment, :date)";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->bindParam(":image_id", $image_id, PDO::PARAM_STR);
		$result->bindParam(":comment", $comment, PDO::PARAM_STR);
		$result->bindParam(":date", $date, PDO::PARAM_STR);
		$result->execute();
		$id = $db->lastInsertId();
		return $id;


	}

	public static function getComments($image_id){
		$db = Db::getConnection();
		$sql = "SELECT * FROM comments WHERE image_id = :image_id";
		$result = $db->prepare($sql);
		$result->bindParam(":image_id", $image_id, PDO::PARAM_INT);
		$result->execute();
		$i = 0;
		$comments = array();
		while ($row = $result->fetch()){

			$comments[$i]['id'] = $row['id'];
			$comments[$i]['user_id'] = $row['user_id'];
			$comments[$i]['image_id'] = $row['image_id'];
			$comments[$i]['comment'] = $row['comment'];
			$comments[$i]['date'] = $row['date'];
			$i++;
		}
		return $comments;
	}

	public static function delCommentById($comment_id){
		$db = Db::getConnection();
		$sql = "DELETE FROM comments WHERE id = :id";
		$result = $db->prepare($sql);
		$result->bindParam(":id", $comment_id, PDO::PARAM_INT);
		$result->execute();
		return $result;
	}
}