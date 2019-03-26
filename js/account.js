window.onload = function(){

	var select = document.getElementById("select");
	select.addEventListener('change', changeMail, false);

	function changeMail(){
		var option = this;
		var user = this.getAttribute('user_id');
		var value = this.value;
		var body = "user_id=" + user + "&value=" + value;
		var req = new XMLHttpRequest();

		req.open("POST", "/account/change/", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
		req.send(body);
		req.onreadystatechange = function(){
			if ((req.readyState == 4) && (req.status == 200))
			{	
				console.log(req.responseText);
			}
		};
	}
}