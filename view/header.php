<!DOCTYPE html>
<html>
<head>
	 <link href="/view/template/main.css" rel="stylesheet">
	  <link href="/view/template/header.css" rel="stylesheet">
	  <link href="/view/template/footer.css" rel="stylesheet">

	
	<title>Camagru</title>
</head>
<body>
	<div class="header">
		<div class="header__section">
			<div class="headerLogo">
				Camagru
			</div>
			<?php if(isset($_SESSION['user'])){?>
			<div class="header__item headerButton">
				<a href="/cam">Home</a></div>
			<div class="header__item headerButton">
				<a href="/gallery">Gallery</a></div>
			<?php } ?>
		</div>
		<div class="header__section">
			<?php if(isset($_SESSION['user'])){?>
			<div class="header__item headerButton">
				<a href="/account">Account</a></div>
			<div class="header__item headerButton">
				<a href="/logout">Log out</a></div>
			<?php } else { ?>
			<div class="header__item headerButton">
				<a href="/login">Log in</a></div>
			<div class="header__item headerButton">
				<a href="/register">Sign up</a></div>
			<?php }?>
		</div>
	</div>
	<div id="wrap">