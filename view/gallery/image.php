<?php require_once (ROOT."/view/header.php"); ?>
 <script src="/js/img.js" type="text/javascript"></script>
<center>
	<div class="container">
		<div class="row justify-content-center">
			<div class="card  mt-3 mb-3" >
				<img class="card-img-top" src="<?php echo(substr($image['path_image'], 1));?>" alt="Card image cap">
				<div class="card-body">
					<div class="d-flex">
						<?php if ($like) {?>
							<div class="like liked" image_id="<?php echo($image['id']);?>" user_id="<?php echo $_SESSION['user'];?>">
						<?php } else {?>
							<div class="like unliked" image_id="<?php echo($image['id']);?>" user_id="<?php echo $_SESSION['user'];?>">
						<?php } ?>
							</div>
							<div class="likes_quantity">
								<h3><?php if($likes_quantity > 0){echo $likes_quantity;}?></h3>
							</div>
							<div id="share" class="ml-auto">
								<div class="social" data-url="<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" data-title="Camagru">		
	
									<a class="push facebook" data-id="fb" onclick="sharing(this);"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a class="push twitter" data-id="tw" onclick="sharing(this);"><i class="fa fa-twitter"></i></a>
									<a class="push google" data-id="gp" onclick="sharing(this);"><i class="fa fa-google-plus"></i></a>
									<a class="push pinterest" data-id="pin" onclick="sharing(this);"><i class="fa fa-pinterest"></i></a>
								</div>
							</div>
					<script src="/js/share.js"></script>
					</div>
				</div>
				<div class="card">
					<ul id="comment-list"class="list-group list-group-flush">
						<?php foreach ($comments as $comment): ?>
    						<li class="list-group-item">
    							<div id="<?php echo $comment['id']; ?>com">
    								<div class="d-flex justify-content-between align-items-center">
    									<small class="text-muted"><?=$comment['user']['login'];?>:</small>
    									<?php if ($user_image['user_id'] == $_SESSION['user'] || $comment['user']['user_id'] == $_SESSION['user']){?>
											<button type="button" class="close" onclick="delComment(this)">
  												<span>&times;</span>
											</button>
										<?php } ?>
    								</div>
    								<div class="text_comment"><?=$comment['comment'];?></div>
									<div class="date_comment"><?=$comment['date'];?></div>
								</div>
    						</li>
    					<?php endforeach ?>
  					</ul>
  					<div class="card-footer">
  						<form method="post">
							<textarea id="comment" class="form-control" placeholder="Write your comment"></textarea>
							<div class="col text-center mt-1">
								<button class="btn btn-outline-primary" type="button" name="submit" onclick="addComment(<?=$_SESSION['user'];?>, <?=$image['id'];?>)">Send Comment</button>
							</div>
						</form>
  					</div>
				</div>
			</div>
		</div>	
	</div>
</center> 
<?php require_once (ROOT."/view/footer.php"); ?>