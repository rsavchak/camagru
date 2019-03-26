	window.onload = function(){
			
		var video = document.getElementById('video');
		var canvas = document.querySelector('canvas');
		var ctx = canvas.getContext('2d');
		var localStream = null;
		var btn = document.getElementById('shot');
		
		function snapshot(){
			if(localStream){
				ctx.drawImage(video, 0, 0);
				

		}
			ctx.restore();
			var drawnImg = document.getElementsByClassName("icon_in_block");

			for (var i = 0; drawnImg[i]; i++)
			{
				console.log(drawnImg[i]);
				canvas.getContext("2d").drawImage(
				drawnImg[i],
				drawnImg[i].style.left.slice(0, -2), drawnImg[i].style.top.slice(0, -2),
				drawnImg[i].width, drawnImg[i].height
				);
			}
			document.getElementById('curImg').src = canvas.toDataURL('image/webp');
			get_buttons();
		}
		
		btn.addEventListener('click', snapshot, false);
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
		
		navigator.getUserMedia({video: true}, function (stream)
		{
			if (typeof (video.srcObject) !== 'undefined'){
				video.srcObject = stream;
			} 
			else {
				video.src = URL.createObjectURL(stream);
			}
			localStream = stream;
		}
		,function (){
		console.log('Stream Error!');
	});

	function get_buttons(){
		var btns = document.getElementById("imgBtns");
		var togal = document.getElementById("togal");
		var source = document.getElementById("curImg");
		console.log(togal);
		if(togal && togal.style.display == 'none')
			togal.style.display = '';
		source = source.src;
		if (source != location.href)
		{
			btns.style.display = 'block';
		}
	}

	var galeryButton = document.getElementById("togal")
	galeryButton.addEventListener('click', toGalery, false);

	function toGalery(){
		var source = document.getElementById("curImg");
		source = source.src;
		var req = new XMLHttpRequest();
		var user_id = document.getElementById("user_id");
		var body = "user_id=" + user_id.innerHTML + "&source=" + source;
	
		req.open("POST", "/upload/", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		req.send(body);
		req.onreadystatechange = function(){
			if ((req.readyState == 4) && (req.status == 200))
			{	
				var img_id = req.responseText.replace(/\D+/ig, '');
				var div = document.createElement('div');
				var img = document.createElement('img');
				var input = document.createElement('input');
				var gallery = document.getElementById('rg');
				var btn = document.getElementById("togal");

				div.setAttribute("id", img_id);
				img.className = "img_gal";
				img.setAttribute("src", source);
				input.className = "del_img";
				input.setAttribute("type", "button");
				input.setAttribute("value", "Delete");
				input.setAttribute("onclick", "delFromGalery(" + img_id + ")"); 
				div.appendChild(img);
				div.appendChild(input);
				gallery.appendChild(div);
				btn.style.display = 'none';

				console.log("image uploaded");
			}
		};
	};

	var icons = document.querySelectorAll(".img_icon");

		for (var i = 0; i < icons.length; i++){
			icons[i].addEventListener('click', addIcon, false);
		}
		function addIcon(){
			var img_icon = document.createElement('img');
			var div = document.querySelector('.icon_block');
			console.log(div);
			img_icon.src = this.src;
			img_icon.setAttribute("width", 200);
			img_icon.setAttribute("height", 150);
			img_icon.className = "icon_in_block";
			div.appendChild(img_icon);
		}
};

	function delFromGalery(id){
		var img = document.getElementById(id);

		var body = "user_id=" + id;
		var req = new XMLHttpRequest();
		req.open("POST", "/delImage/" + id + "/", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		req.send(body)
		req.onreadystatechange = function(){
			if ((req.readyState == 4) && (req.status == 200))
			{
				img.remove();
				console.log(req.responseText);
			}
		};
	};