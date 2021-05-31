//Close load screen on timeout
function close_p(){
	document.getElementById("main").style.display = 'block';
	document.getElementById("presentation").style.opacity = '0';	
	console.log("closed");
	document.getElementById("main").style.opacity = '1';	
	setTimeout(() => { document.getElementById("presentation").style.display = 'none';}, 500);
	//Disabling slimes after some time because they are resource intence
	setTimeout(() => { document.getElementById("slimes").style.opacity = '0';}, 20000);
	setTimeout(() => { document.getElementById("slimes").style.display = 'none';}, 22000);
	//Showing slime warning after
	setTimeout(() => { document.getElementById("slime_warning").style.display = 'block';}, 22000);
}
document.addEventListener("DOMContentLoaded", function() {
	setTimeout(() => { close_p(); }, 500);
});

//After disabling slimes
function enable_slimes(){
	document.getElementById("slimes").style.opacity = '1';
	document.getElementById("slimes").style.display = 'block';	
}
//Background
function draw() {
  var k = 0;
  var imgh = 8;
  var ctx = document.getElementById('canvas').getContext('2d');
  data.forEach(function(item, i , arr){
	  var img = new Image();
	  img.onload = function() {
		  ctx.drawImage(img, (k*imgwidth)%(imgh*imgwidth), parseInt(k/imgh)*imgheight, imgwidth, imgheight);
		  console.log("loaded "+item);
		  k=k+1;
	  }
	  img.src = item;
  });

}
canvas = document.getElementById("canvas");
canvas.width = document.body.clientWidth*3;
canvas.height = document.body.clientHeight*3;