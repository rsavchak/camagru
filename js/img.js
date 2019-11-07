	function addComment(user_id, image_id){
		var text = document.getElementById("comment");
		if (text.value != "")
		{
			if(text.value.length > 2000)
				text.value = text.value.substr(0, 2000);
			var req = new XMLHttpRequest();
			var body = "user_id=" + user_id + "&image_id=" + image_id +"&comment=" + text.value;
			
			req.open("POST", "/comment/addComment/", true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
			req.send(body);
			
			req.onreadystatechange = function(){
				if ((req.readyState == 4) && (req.status == 200))
				{
					var response = (JSON.parse(req.responseText));
					if (!response)
						return;
					var comment_id = response.id.replace(/\D+/ig, '');
					if (comment_id)
						comment_id += 'com';
					var parrentCom = document.getElementById('comment-list');
					var li = document.createElement('li');
					var div = document.createElement('div');
					var divDel = document.createElement('div');
					var divText = document.createElement('div');
					var divDate = document.createElement('div');
					var options = { month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false, };
					var date  = new Date();

					var top_line = document.createElement('div');
					var login = document.createElement('small');
					var del = document.createElement('button');

					top_line.className = "d-flex justify-content-between align-items-center";
					login.className = "text-muted"; 
					login.innerText = response.login;
					del.className = "close";
					del.setAttribute('type', 'button');
					del.setAttribute('onclick', 'delComment(this)');
					del.innerHTML = "<span>&times;</span>";
					top_line.appendChild(login);
					top_line.appendChild(del);

					date = date.toLocaleDateString("en-US", options);
					text.value = escapeHtml(text.value);
					divText.innerHTML = text.value;
					divDate.innerHTML = date;

					divText.className = "text_comment";
					divDate.className = "date_comment";
					div.setAttribute("id", comment_id);
					div.appendChild(top_line);
					div.appendChild(divText);
					div.appendChild(divDate);
					li.appendChild(div);
					li.className = "list-group-item";
					parrentCom.appendChild(li);
					text.value = "";
					scroll();
				}
			};
		}
	}

	function escapeHtml(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

	function delComment(elem)
	{
		var div = elem.parentElement.parentElement;
		var comment_id = parseInt(div.id);
		var body = "comment_id=" + comment_id;
		var req = new XMLHttpRequest();

		req.open("POST", "/comment/delComment/", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		req.send(body);
		req.onreadystatechange = function(){
			if ((req.readyState == 4) && (req.status == 200))
				div.parentElement.remove();
				scroll();
		};
	}

	function scroll(){
			var comments = document.querySelector("#comment-list");
			var commentsQuantity = comments.children.length;

			if(comments.offsetHeight > 325 || commentsQuantity > 4){
				comments.setAttribute('style', 'max-height: 325px; overflow-y: scroll;');
			} else{
				comments.removeAttribute('style');
			}
		}

	window.onload = function(){

		var like = document.querySelector(".like");
		like.addEventListener('click', addLike, false);

		function addLike(){
			var user_id = this.getAttribute("user_id");
			var image_id = this.getAttribute("image_id");
			var body = "user_id=" + user_id + "&image_id=" + image_id;
			var quantity = document.getElementsByClassName("likes_quantity")[0].childNodes[1];
			var req = new XMLHttpRequest();
			var self = this;
			self.className == "like unliked" ? req.open("POST", "/like/addLike/", true) : req.open("POST", "/like/dissLike/", true);

			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send(body)
			req.onreadystatechange = function(){
				if ((req.readyState == 4) && (req.status == 200))
				{
					if (req.responseText == 'like'){
						quantity.innerHTML = Number(quantity.innerHTML) + 1;
						self.className = "like liked"
					} else if (req.responseText == 'dislike'){
						self.className = "like unliked"
						quantity.innerHTML = Number(quantity.innerHTML) - 1;
						if (quantity.innerHTML == 0)
							quantity.innerHTML = "";
					}
				}
			};

		}

		
		scroll();
		
	}
