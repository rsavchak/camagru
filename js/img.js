	function addComment(user_id, image_id){
		var text = document.getElementById("comment");
		if (text.value != "")
		{
			var req = new XMLHttpRequest();
			var body = "user_id=" + user_id + "&image_id=" + image_id +"&comment=" + text.value;
			
			req.open("POST", "/comment/addComment/", true);
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
			req.send(body)
			
			req.onreadystatechange = function(){
				if ((req.readyState == 4) && (req.status == 200))
				{
					var comment_id = req.responseText.replace(/\D+/ig, '');
					if (comment_id)
						comment_id += 'com';
					var parrentCom = document.getElementById("comBlock");
					var div = document.createElement('div');
					var divDel = document.createElement('div');
					var divText = document.createElement('div');
					var divDate = document.createElement('div');
					var options = { month: 'short', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false, };
					var date  = new Date();
					var hr = document.createElement('hr');

					date = date.toLocaleDateString("en-US", options);
					divDel.innerHTML = 'x';
					text.value = escapeHtml(text.value);
					divText.innerHTML = text.value;
					divDate.innerHTML = date;
					divDel.setAttribute("id", 'delete_comment');
					divDel.setAttribute("onclick", "delComment(this)");
					divText.className = "text_comment";
					divDate.className = "date_comment";
					div.className = "commentBox";
					div.setAttribute("id", comment_id);
					div.appendChild(divDel);
					div.appendChild(divText);
					div.appendChild(divDate);
					div.appendChild(hr);
					parrentCom.appendChild(div);
					text.value = "";
					console.log(req.responseText);
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
		var div = elem.parentElement;
		var comment_id = parseInt(div.id);
		var body = "comment_id=" + comment_id;
		var req = new XMLHttpRequest();

		req.open("POST", "/comment/delComment/", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		req.send(body);
		req.onreadystatechange = function(){
			if ((req.readyState == 4) && (req.status == 200))
			{	
				console.log(req.responseText);
				div.remove();
			}
		};
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
			
			if (this.className == "like unliked")
			{	req.open("POST", "/like/addLike/", true);
				quantity.innerHTML = Number(quantity.innerHTML) + 1 ;
				this.className = "like liked"
			}
			else{
				this.className = "like unliked"
				req.open("POST", "/like/dissLike/", true);
				quantity.innerHTML = Number(quantity.innerHTML) - 1 ;
				if (quantity.innerHTML == 0)
					quantity.innerHTML = "";
			}
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			req.send(body)
			req.onreadystatechange = function(){
				if ((req.readyState == 4) && (req.status == 200))
				{
					console.log(req.responseText);
					//location.reload();
				}
			};

		}
	}
