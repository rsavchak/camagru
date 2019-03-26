var startX = 0;
var startY = 0;
var offsetX = 0;
var offsetY = 0;
var dragElement;
var oldZIndex = 0;

InitDragDrop();

function InitDragDrop(){
	document.onmousedown = OnMouseDown;
	document.onmouseup = OnMouseUp;
	document.onwheel = OnWheel;
}

function OnMouseDown(e){
	if (e == null)
		e = window.event;

	var target = e.target;
	if (target.className == 'icon_in_block')
		console.log('clicked');
	if ((e.which == 1 && window.event != null || e.button == 0) &&
		target.className == 'icon_in_block')
	{
		startX = e.clientX;
		startY = e.clientY;
		offsetX = ExtractNumber(target.style.left);
		offsetY = ExtractNumber(target.style.top);

		oldZIndex = target.style.zIndex;
		target.style.zIndex = 10000;

		dragElement = target;

		document.onmousemove = OnMouseMove;

		document.body.focus();

		document.onselectstart = function(){return false;};
		target.ondragstart = function(){return false;};
		return false;
	}
	if (e.which == 2 && target.className == 'icon_in_block')
		target.remove();
}

function OnMouseMove(e){
	if (e == null)
		var e = window.event;

	dragElement.style.left = (offsetX + e.clientX - startX) + 'px';
	dragElement.style.top = (offsetY + e.clientY - startY) + 'px';
}

function OnWheel(e){
	var e = e || window.event;
	var target = e.target;

	if (e.target.className == "icon_in_block"){
		e.preventDefault();	
		var width = target.offsetWidth;
		var height = target.offsetHeight;	
		addOnWheel(target, e, width, height);
	}
}
	function addOnWheel(target, e, width, height){
			var delta = e.deltaY || e.deltaX;

			 if (delta < 0 && width <= 500){
			 	width *= 1.1;
			 	height *= 1.1;
			 }
			 else if(delta > 0 && width >= 40){
			 	width /= 1.1;
			 	height /= 1.1;
			 }
			 console.log(width);
			target.style.width = width + 'px';
			target.style.height = height + 'px';
		};

function OnMouseUp(e){
	if (dragElement != null)
	{
		dragElement.style.zIndex = oldZIndex;
		document.onmousemove = null;
		document.onselectstart = null;
		dragElement.ondragstart = null;
	}
}

function ExtractNumber(value){
	var n = parseInt(value);
	return n == null || isNaN(n) ? 0 : n;
}