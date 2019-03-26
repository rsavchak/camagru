<?php

class LikeController{
	public function actionAddLike(){
		if (isset($_POST))
		{
			$user_id = $_POST['user_id'];
			$image_id = $_POST['image_id'];
			$res = Like::addLike($image_id, $user_id);
			if ($res)
				echo "SUCCESS";
		}
		return true;
	}

	public function actionDissLike(){
		if (isset($_POST))
		{
			$user_id = $_POST['user_id'];
			$image_id = $_POST['image_id'];
			$res = Like::dissLike($image_id, $user_id);
			if ($res)
				echo "SUCCESS";
		}
		return true;
	}
}