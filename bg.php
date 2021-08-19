<?php
//background images from twitch thumbnails (populated daily)
header("Access-Control-Allow-Origin: api.enviosity.com");
$bg_images = json_decode(file_get_contents("./envi.json"));
//Bg settings
$imgh = 160;
?>

<html>
<head>
	<title>Enviosity<?=($live)?"🔴 NOW LIVE!":"";?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta charset="utf-8">
	<meta name="description" CONTENT="Enviosity's f2p website">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<!-- Fontawesome icons -->
	<link rel="stylesheet" href="./assets/fa/css/all.min.css">
	<link rel="stylesheet" href="./assets/main.css">
</head>
<body onload="draw();">
	<div id="cover"></div>
	<canvas id="canvas" width="100%" height="100%"></canvas>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	//Background
	/*/
		TODO rewrite this shit to ajax
	/*/
	
	data = [
	<?php
		foreach($bg_images->data as $dat){
			if(!empty($dat->thumbnail_url)){
				$dat->thumbnail_url = str_replace("%{width}", (int)($imgh/9*16), $dat->thumbnail_url);
				$dat->thumbnail_url = str_replace("%{height}", $imgh, $dat->thumbnail_url);
				echo '"'.explode("cf_vods/", $dat->thumbnail_url)[1].'",';
			}
		}
	?>
	];
	var imgwidth = <?=$imgh/9*16;?>;
	var imgheight = <?=$imgh;?>;
	var num = 0;
	//Background
	function draw() {
	  var k = 0;
	  var imgh = 6;
	  var count = 0;
	  var ctx = document.getElementById('canvas').getContext('2d');
	  t = [2,3,5,6,7,8,8,7,6,5,3];
	  kt = [1,2,3,4,5,6,5,4,3,2,1];
	  ctx.rotate(-30*Math.PI/180);
	  ctx.transform(4.5,0,0,4.5,0,0);
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
		  img.src = "https://static-cdn.jtvnw.net/cf_vods/"+item;
	  });

	}
	canvas = document.getElementById("canvas");
	scale = document.body.clientWidth/document.body.clientHeight;
	width = 2560*3;
	height = width/scale;
	canvas.width = width;
	canvas.height = height;
	</script>
</body>
</html>
