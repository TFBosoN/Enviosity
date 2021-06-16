//Close load screen on timeout
function close_p(){
	document.getElementById("slimes").style.opacity = '1';
	document.getElementById("slimes").style.display = 'inline-table';
	document.getElementById("main").style.display = 'block';
	document.getElementById("presentation").style.opacity = '0';	
	console.log("Presentation closed");
	document.getElementById("main").style.opacity = '1';	
	setTimeout(() => { document.getElementById("presentation").style.display = 'none';}, 400);
	//Disabling slimes after some time because they are resource intence
	setTimeout(() => { document.getElementById("slimes").style.opacity = '0';}, 20000);
	setTimeout(() => { document.getElementById("slimes").style.display = 'none';}, 22000);
	//Showing slime warning after
	setTimeout(() => { document.getElementById("slime_warning").style.display = 'block';}, 22000);
}


//After disabling slimes
function enable_slimes(){
	document.getElementById("slimes").style.opacity = '1';
	document.getElementById("slimes").style.display = 'inline-table';
	document.getElementById("slime_warning").style.display = 'none';
}
//Background
function draw() {
  var k = 0;
  var imgh = 6;
  var count = 0;
  var ctx = document.getElementById('canvas').getContext('2d');
  t = [2,3,5,6,7,8,8,7,6,5,3];
  kt = [1,2,3,4,5,6,5,4,3,2,1];
  ctx.rotate(-30*Math.PI/180);
  ctx.transform(2,0,0,2,0,0);
  data.forEach(function(item, i , arr){
	  var img = new Image();
	  img.onload = function() {
		  count++;
		  col = -0.5 + parseInt(count%t[k])-kt[k]/3;
		  row = k;
		  ctx.drawImage(img, col*imgwidth, row*imgheight, imgwidth, imgheight);
		  if(count%t[k]==0){
			  k++;
			  count = 0;
		  }
	  }
	  img.src = item;
  });

}
canvas = document.getElementById("canvas");
scale = document.body.clientWidth/document.body.clientHeight;
width = 2560*3;
height = width/scale;
canvas.width = width;
canvas.height = height;