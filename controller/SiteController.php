<?php

class SiteController{

	public function actionIndex(){
		if(isset($_SESSION['user']) && $_SESSION['user'] != NULL)
			header("Location: /cam/");
		else
			header("Location: /setup/");
		return true;
	}

	public function actionSetup(){
		require_once (ROOT."/config/setup.php");
		$result = Setup::create();
		header("Location: /login/");
		return true;
	}

	public function actionCam(){
		if (empty($_SESSION['user']))
			header("Location: /login/");		
		$user_id = $_SESSION['user'];
		$images = Image::getImagesByUserId($user_id);
		$icons = Image::getIcons();
		require_once (ROOT."/view/cam.php");
		return true;
	}

	public function actionUpload(){
		if (isset($_POST))
		{
			$user_id = intval($_POST['user_id']);

			$source = "./galery/temp.png";
			$path = "./galery/" . $user_id . time() . ".png";
			var_dump($_POST, $source);
			if (strstr($_POST['source'], substr($source, 1)))
				$img = file_get_contents($source);
			if (!is_dir("./galery/"))
				mkdir("./galery/");
			file_put_contents($path, $img);
			$res = Image::uploadImage($user_id, $path);
			if ($res)
				echo "$res";
		}
		return true;
	}


	public function actionDelImage($id){
		if (isset($_POST))
		{
			$user_id = intval($_POST['user_id']);
			$image = Image::getImageById($id);
			$path = $image['path_image'];
			unlink($path);
			$result = Image::deleteImageById($id);
			if ($result)
				echo "Image was deleted";
		}
		return true;
	}


}