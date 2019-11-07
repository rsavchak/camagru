<?php

class Image{
	const SHOW_BY_DEFAULT = 6;
	
	public static function uploadImage(int $user_id, string $path_image){
		$db = Db::getConnection();
		$sql = "INSERT INTO images (user_id, path_image) 
		VALUES (:user_id, :path_image)";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->bindParam(":path_image", $path_image, PDO::PARAM_STR);
		$result->execute();
		if ($result)
			return	$id = $db->lastInsertId();
	}

	public static function getImagesByUserId(int $user_id){
		$images = array();
		$db = Db::getConnection();
		$sql = "SELECT * FROM images WHERE user_id = :user_id";
		$result = $db->prepare($sql);
		$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->execute();
		$i = 0;
		while ($row = $result->fetch()){
			$images[$i]['id'] = $row['id'];
			$images[$i]['user_id'] = $row['user_id'];
			$images[$i]['path_image'] = $row['path_image'];
			$i++;
		}
		return $images;
	}

	public static function getImagesByPage($page = 1){
		if(preg_match('/page-/', $page))
			$page = intval(substr($page, 5));
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
		$images = array();
		$db = Db::getConnection();
		$sql = "SELECT * FROM images LIMIT " . self::SHOW_BY_DEFAULT . " OFFSET " . $offset;
		$result = $db->prepare($sql);
		//$result->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$result->execute();
		$i = 0;
		while ($row = $result->fetch()){
			$images[$i]['id'] = $row['id'];
			$images[$i]['user'] = Account::getUserByImage($row['id']);;
			$images[$i]['path_image'] = $row['path_image'];
			$images[$i]['likes'] = intval(Like::getLikes($row['id']));
			$i++;
		}
		return $images;
	}

	public static function getTotalImages()
	{
		$db = Db::getConnection();
		 $result = $db->query('SELECT count(id) AS count FROM images');
		 $result->setFetchMode(PDO::FETCH_ASSOC);
		 $row = $result->fetch();

		 return $row['count'];
	}

	public static function deleteImageById(int $id){
		$db = Db::getConnection();
		$sql = "DELETE FROM images WHERE id = :id";
		$result = $db->prepare($sql);
		$result->bindParam(":id", $id, PDO::PARAM_INT);
		$result->execute();
		return $result;
	}

	public static function getImageById(int $id){
		$db = Db::getConnection();
		$sql = "SELECT * FROM images WHERE id = :id";
		$result = $db->prepare($sql);
		$result->bindParam(":id", $id, PDO::PARAM_INT);
		$result->execute();
		$row = $result->fetch();
		$image['id'] = $row['id'];
		$image['user_id'] = $row['user_id'];
		$image['path_image'] = $row['path_image'];
		return $image;
	}

	public static function getIcons(){
		$directory = "./frames/";
		$icons = array_diff(scandir($directory), array('..', '.'));
		if ($icons)
			return $icons;
		return false;
	}

	public static function makeImage(array $icons, string $photo){
		if (file_exists('./galery/temp.png'))
			unlink('./galery/temp.png');
		if (strstr($photo, 'data:image/webp;base64,'))
			$image_string = str_replace("data:image/webp;base64,", "", $photo);
		else
			$image_string = str_replace("data:image/png;base64,", "", $photo);
		$image_string = str_replace(" ", "+", $image_string);
		$image_string64 = base64_decode($image_string);
		
		$image = imagecreatefromstring($image_string64);
			
		foreach ($icons as $key => $icon) {
			$src = "." . strstr($icon['src'], "/frames/");
			$img = imagecreatefrompng($src);
			$sx = $icon['width'];
			$sy = $icon['height'];
			$old_w = imagesx($img);
			$old_h = imagesy($img);
			imagecopyresampled($image, $img, $icon['x'], $icon['y'], 0, 0, $sx, $sy, $old_w, $old_h);
		}
		
		imagepng($image, './galery/temp.png', 0);
		imagedestroy($image);
		if (isset($image))
			return '/galery/temp.png';
		
		return false;
	}
}