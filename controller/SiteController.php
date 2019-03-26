<?php

class SiteController{

	public function actionIndex(){
		if($_SESSION['user'] != NULL)
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
		if (!$_SESSION['user'])
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
			$source = $_POST['source'];
			$path = "./galery/" . $user_id . time() . ".png";

			$img = str_replace("data:image/png;base64,", "", $source);
			$img = str_replace(" ", "+", $img);
			$dec = base64_decode($img);
			if (!is_dir("./galery/"))
				mkdir("./galery/");
			file_put_contents($path, $dec);
			$res = Image::uploadImage($user_id, $path, $dec);
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