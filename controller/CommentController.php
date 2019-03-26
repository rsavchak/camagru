<?php

class CommentController{

	public function actionAddComment(){
		if (isset($_POST))
		{
			$user_id = $_POST['user_id'];
			$image_id = $_POST['image_id'];
			$comment = $_POST['comment'];
			$comment = htmlentities($comment);
			$res = Comment::addComment($image_id, $user_id, $comment);
			$user_image = Account::getUserByImage($image_id);
			if ($user_image['mail_com'] == 1)
				Mail::sendCommentMail($user_image);
			if ($res){
				echo "$res";
			}
		}
		return true;
	}

	public function actionDelComment(){
		if (isset($_POST))
		{
			$comment_id = $_POST['comment_id'];
			$res = Comment::delCommentById($comment_id);
			if ($res)
			{
				echo "comment deleted";
				return true;
			}
		}
		return false;
	}
}