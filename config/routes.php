<?php
return array(

	"gallery/image/([0-9]+)" => "gallery/image/$1",
	"gallery/page-([0-9]+)" => "gallery/index/$1",
	"comment/addComment" =>"comment/addComment",
	"comment/delComment" =>"comment/delComment",
	"like/addLike" =>"like/addLike",
	"like/dissLike" =>"like/dissLike",
	"gallery" => "gallery/index",
	"delImage/([0-9]+)" => "site/delImage/$1",
	"confirm/([a-z0-9]{40}$)" => "account/confirm/$1",
	"account/change" => "account/change",
	"register" => "account/register",
	"login" => "account/login",
	"logout" => "account/logout",
	"reset" => "account/reset",
	"edit" => "account/edit",
	"account" => "account/index",
	"setup" => "site/setup",
	"cam" => "site/cam",
	"upload" => "site/upload",
	"" => "site/index",
);