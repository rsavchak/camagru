<!DOCTYPE html>
<html class="h-100">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="/view/template/main.css" rel="stylesheet">
	  <link href="/view/template/header.css" rel="stylesheet">
	  <link href="/view/template/footer.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	   <script src="/js/cams.js" type="text/javascript"></script>
	<title>Camagru</title>
</head>
<body class="d-flex flex-column h-100">
	<nav id="header" class="navbar navbar-expand-sm navbar-dark navbar-fixed-top">
		<div class="container">
			<div class="headerLogo"><a href="/gallery">Camagru</a></div>
			<button onclick="(function () {
				var menu = document.getElementById('my-nav');
				(menu.classList.contains('show')) ? menu.classList.remove('show') :
				 menu.classList.add('show');
			}())" class="navbar-toggler" type="button" data-target="#my-nav" data-toggle="collapse"><span class="navbar-toggler-icon"></span></button>
			<div id="my-nav" class="collapse navbar-collapse">
				<?php if(isset($_SESSION['user'])){?>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item ml-3">
							<a class="nav-link" href="/cam">Home</a>
						</li>
						<li class="nav-item ml-3">
							<a class="nav-link" href="/gallery">Gallery</a>
						</li>
					<li class="nav-item ml-3">
						<a class="nav-link" href="/account">Account</a>
					</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item ml-3">
							<a class="nav-link" href="/logout">Log out</a>
						</li>
				<?php } else { ?>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item ml-3">
							<a class="nav-link" href="/login">Log in</a>
						</li>
						<li class="nav-item ml-3">
							<a class="nav-link" href="/register">Sign up</a>
						</li>
				<?php }?>
					</ul>
			</div>
		</div>
	</nav>