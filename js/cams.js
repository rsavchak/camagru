	window.onload = function(){
		
		var video = document.getElementById('video');
		var canvas = document.querySelector('canvas');
		if (canvas)
			var ctx = canvas.getContext('2d');
		var localStream = null;
		var btn = document.getElementById('shot');
		var icon_block = document.querySelector('.icon_block');
		
		function snapshot(){
			var upload_image = document.getElementById('uploaded_img');
			var input = document.getElementById('file-input');
			var upload_photo = document.getElementById('upload');
			var image;
			var curImg = document.getElementById('curImg');
			if(curImg.getAttribute('src') != "")
				curImg.setAttribute('src', '');
			if (localStream){
				 ctx.drawImage(video, 0, 0);
				 image = canvas.toDataURL('image/webp');
			} else if (uploaded_img.getAttribute('src') != "")
			{
				ctx.drawImage(uploaded_img, 0, 0, 640, 480);	
				image =  canvas.toDataURL('image/webp');
			} else
				return;
			ctx.restore();
			
			var drawnImg = document.getElementsByClassName("icon_in_block");
			var xScale = 640 / document.querySelector('.icon_block').offsetWidth; 
			var yScale = 480 / document.querySelector('.icon_block').offsetHeight;
			var images = [];
			for (var i = 0; drawnImg[i]; i++)
			{
				var object = {};
				object.src = drawnImg[i].getAttribute('src');
				object.width = drawnImg[i].width * xScale;
				object.height =  drawnImg[i].height * yScale;
				object.x = drawnImg[i].style.left.slice(0, -2) * xScale;
				object.y = drawnImg[i].style.top.slice(0, -2) * yScale;
				
				images[i] = JSON.stringify(object);
			}
			images = JSON.stringify(images);
			var req = new XMLHttpRequest();
			var body = "images=" + images + "&camera=" + image;
			req.open("POST", "/gallery/makeImage/", true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
			req.send(body)
			req.onreadystatechange = function(){
				if ((req.readyState == 4) && (req.status == 200))
				{
					d = new Date();
					curImg.src = req.responseText + '?' + d.getTime();
					get_buttons();
					if (uploaded_img.getAttribute('src') != ""){
						uploaded_img.src = "";
						changeDisplay(uploaded_img);
						changeDisplay(icon_block);
						changeDisplay(input);
						if (upload_photo.files[0])
							upload_photo.value = "";
						while(icon_block.firstChild){
						icon_block.firstChild.remove();
						}
					}
				}
			};
		}

		if(btn)
			btn.addEventListener('click', snapshot, false);
		navigator.mediaDevices.getUserMedia = navigator.mediaDevices.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
		if (video)
			navigator.mediaDevices.getUserMedia({video: true})
		.then(function(mediaStream) {
			if (typeof (video.srcObject) !== 'undefined'){
				video.srcObject = mediaStream;
			} 
			else {
				video.src = URL.createObjectURL(mediaStream);
			}
			localStream = mediaStream;
		})
		.catch(function (err){
		console.log(err.name + ": " + err.message);
		document.getElementById('video').classList.add('d-none');
		var input = document.getElementById('file-input');
		changeDisplay(input);
		icon_block.classList.add('d-none');
	});

	function get_buttons(){
		var btns = document.getElementById("imgBtns");
		var togal = document.getElementById("togal");
		var source = document.getElementById("curImg");
		if(togal && togal.style.display == 'none')
			togal.style.display = '';
		source = source.src;
		if (source != "")
		{
			btns.style.display = 'block';
		}
	}


	function changeDisplay(object)
	{
		if (object.classList.contains('d-none')){
			object.classList.remove('d-none');
			object.classList.add('d-flex');
		} else if(object.classList.contains('d-flex')){
			object.classList.remove('d-flex');
			object.classList.add('d-none');
		}
	}

	var upload_photo = document.getElementById('upload');
	if (upload_photo)
		upload_photo.addEventListener('change',function(){
		var photo = upload_photo.files[0];
		var reader = new FileReader();
		var uploaded_img = document.getElementById('uploaded_img');
		reader.onload = function(event){
			uploaded_img.src = event.target.result;
		}
		reader.readAsDataURL(photo);
		var input = document.getElementById('file-input');
		changeDisplay(input);
		changeDisplay(uploaded_img);
		changeDisplay(icon_block);

	},false);

	var galeryButton = document.getElementById("togal")
	if(galeryButton)
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
			}
		};
	};

	var icons = document.querySelectorAll(".img_icon");

		for (var i = 0; i < icons.length; i++){
			icons[i].addEventListener('click', addIcon, false);
		}
		function addIcon(){
			var img_icon = document.createElement('img');
			img_icon.src = this.src;
			img_icon.setAttribute("width", 200);
			img_icon.setAttribute("height", 150);
			img_icon.className = "icon_in_block";
			icon_block.appendChild(img_icon);
		}
};

	function delFromGalery(id, path){
		if (!confirm('Do you want delete this photo?'))
			return false;
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
			}
		};
	};