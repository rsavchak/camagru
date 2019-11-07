<?php

class GalleryController{
	
	public function actionIndex($page = 1){
		$user_id = $_SESSION['user'] ?? "";
		$images = Image::getImagesByPage($page);
		$total = Image::getTotalImages();
		$pagination = new Pagination($total, $page, Image::SHOW_BY_DEFAULT, 'page-');
		require_once (ROOT."/view/gallery/index.php");
		return true;
	}

	public function actionImage($id){
		if (empty($_SESSION['user']))
			header("Location: /login/");	
		$user_id = $_SESSION['user'];
		$image = Image::getImageById($id);
		$comments = Comment::getComments($image['id']);
		$user_image = Account::getUserByImage($image['id']);
		$like = Like::checkLike($_SESSION['user'], $image['id']);
		$likes_quantity = intval(Like::getLikes($image['id']));
		require_once (ROOT . "/view/gallery/image.php");
		return true;
	}


	public function actionMakeImage(){
		if (isset($_POST))
		{
			if (!empty($_POST['images'])){
				$icons_json = json_decode($_POST['images'], true);
				$icons = [];
				foreach ($icons_json as $item) {
					$icons[] = json_decode($item, true);
				}
			}
			
			$image = Image::makeImage($icons, $_POST['camera']);
			if (!empty($image))
				echo $image; //"/galery/temp.png";
		}
		return true;
	}

}