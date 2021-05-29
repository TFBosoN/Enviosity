<?php
//background images from twitch thumbnails (populated daily)
$bg_images = json_decode(file_get_contents("./envi.json"));
//Bg settings
$imgh = 360;
$zoom = 2;

//COPIUM 
$copium_overdose = false;
$copium_icon = '<img src="//enviosity.com/assets/COPIUM.png" width="64" alt="COPIUM" title="COPIUM">';

//RNG names
$names = explode("\n", file_get_contents("./envi_names.txt"));
$count = rand(0,count($names)-1);

//RNG phrases on load screen
$phrase = array("NO MORE<br>F2P DAMAGE!", "\"BEST STREAMER IN THE WORLD!\"<br>--Barack Obama",'<img src="//enviosity.com/assets/enviLove.png" width="160" alt="enviLove" title="enviLove">', '<img src="//enviosity.com/assets/slime.png" width="185" alt="slime" title="slime">', '<img src="//enviosity.com/assets/enviAyaya.png" width="185" alt="enviAyaya" title="enviAyaya">');
//$phrase = array("0 days without<br><img src='//enviosity.com/assets/WeirdChamp.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> and <img src='//enviosity.com/assets/monkaTOS.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> in the chat");
$phrase = $phrase[rand(0, count($phrase)-1)];


//Slime RNG functions
function get_spin(){
	$spin = (rand(0, 1))? "s":"";  
	$speed = rand(45, 85)/10;
	$temp = rand(45, 270)/10;
	$speed = ($speed < $temp)? $temp: $speed;
	return array($spin, $speed);
}
function get_movement(){
	$spin = (rand(0, 1))? "s":"";  
	$speed = rand(50, 110)/10;
	$temp = rand(50, 190)/10;
	$speed = ($speed < $temp)? $temp: $speed;
	if(rand(0,1)){
		$top = rand(0, 720);
		$temp = rand(0, 720);
		$top = ($top > $temp)? $temp: $top;
		$left = rand(0, 720);
		$temp = rand(0, 720);
		$left = ($left > $temp)? $temp: $left;
	}else{
		$top = rand(0, 20);
		$left = rand(0, 20);
	}
	return array($top, $left, $spin, $speed);
}

//Some special site looks RNG
/*
if($names[$count]=="Coderviosity" && !isset($_GET["real_site_pls"])){
	die("<body><h1 style='color:red'>Hello!</h1><blockquote><br>&#171;I do know how to code&#187;</blockquote><figcaption>--Coderviosity, <cite>05/28/2021</cite><br><br><a href='?real_site_pls'>Real site please!</body>");
}
*/

$avatar = "//enviosity.com/assets/avatar.png";
switch($names[$count]){
	case "Daddyosity":
	case "Daddy Envi":
		$names[$count] .= " <img src='//enviosity.com/assets/enviGasm.png' width='32' alt='enviGasm' title='enviGasm'>";
	break;
	case "Dylan":
	case "Dylan the villain":
	case "Dylanosity":
		$avatar = "//enviosity.com/assets/dylan.png";
	break;
	case "Eulanosity":
		$avatar = "//enviosity.com/assets/eulaviosity.png";
	break;
	case "Copiosity":
		$avatar = "https://i.imgur.com/wtaJ1zB.png";
		$copium_overdose = true;
		$phrase = '<img src="//enviosity.com/assets/COPIUM.png" width="160" alt="COPIUM" title="COPIUM">';
	break;
}


?>

<html>
<head>
	<title>Enviosity</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta charset="utf-8">
	<meta name="description" CONTENT="Enviosity's f2p website">
	<meta name="keywords" content="enviosity, f2p, gamer, streamer, youtube, social, genshin, impact, genshin impact, slipper">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<!-- Fontawesome icons -->
	<link rel="stylesheet" href="//enviosity.com/assets/fa/css/all.min.css">
	<style>
		* {
			color: white;
		}
		@font-face {
			font-family: 'Segoe Print’;
			src: url(‘//enviosity.com/assets/segoepr.ttf’);  
		}
		body{
			margin:0;
			padding:0;
			text-align:center;
			user-select: none;
			font-family: "Segoe Print";
		}
		.container{
			height:100%;
			text-align: center;
			z-index:12;
			position: relative;
		}
		.main{
			opacity:0;
			-webkit-transition: opacity 0.5s ease-in-out;
			-moz-transition: opacity 0.5s ease-in-out;
			transition: opacity 0.5s ease-in-out;
			height: 100%;
		}
		.logo{
			margin-top: 50px;
			position: relative;
			display: block;
			top: 20px;
			left: 50%;
			transform: translate(-50%, 20px);
			width: 300px;
		}
		.logo div{
			background-image:url('<?=$avatar;?>');
			max-width: 100%;
			width:100%;
			height:auto;
			display:block;
			/* div height to be the same as width*/
			padding-top:100%;

			/* make it a circle */
			border-radius:50%;

			/* Centering on image`s center*/
			background-position-y: center;
			background-position-x: center;
			background-repeat: no-repeat;

			/* it makes the clue thing, takes smaller dimension to fill div */
			background-size: cover;

			/* it is optional, for making this div centered in parent*/
			margin: 0 auto;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			border:2px dashed black;
		}
		.button {
			transition-duration: 0.4s;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			color:white;
			border: 1px dashed white;
			width: 120px;
			border-radius: 50px;
		}

		.twitch:hover i{
			color: #6441a5;
		}
		.merch:hover i{
			color: #E88245;
		}
		.youtube:hover i{
			color: #c4302b;
		}
		.twittor:hover i{
			color: #00acee;
		}
		.discord:hover i{
			color: #7289da;
		}
		.instogram:hover i{
			color: #c13584;
		}
		.tiktok:hover i{
			color: #111111;
			text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
		}
		.footer{
			position:absolute;
			bottom:20px;
			left: 50%;
			transform: translate(-50%,0);
		}
		#popup{
			display:block;
			position:fixed;
			width: 100%;
			height: 100%;
			top:0;
			left:0;
			background: rgba(0,0,0,0.5);
		}
		#presentation{
			display:block;
			position:fixed;
			width: 100%;
			height: 100%;
			top:0;
			left:0;
			z-index:2;
			overflow:hidden;
			background: linear-gradient(to bottom right,#31394e,#1d212d,#191e33,#141829,#101321);
			-webkit-transition: opacity 0.5s ease-in-out;
			-moz-transition: opacity 0.5s ease-in-out;
			transition: opacity 0.5s ease-in-out;
		}
		#presentation h1{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			margin: 0;
		}
		#popup_blocker{
			display:block;
			position:fixed;
			width: 100%;
			height: 100%;
			top:0;
			left:0;
			z-index:999;
		}
		.AYAYA_social h1{
			font-size:40px;
			height:30px;
		}
		.credits{
			font-size:10px;
			opacity: 0.9;
			color: lightgray;
		}
		.credits a{
			color: lightgray;
		}
		.credits img{
			vertical-align: middle;
		}
		.banner{
			font-size: 100px;
		}
		body{
			background: black;
			overflow-x: hidden;
		}
		canvas {
			position:fixed;
			top:0;
			left:0;
			width:100%;
			height:100%;
			z-index:-1;
			display:block;
			background:black;
			transform: rotate(-30deg) scale(<?=$zoom;?>);
			transform-origin: 33.33% 25%;
		}
		#cover{
			z-index:9;
			width:100%;
			height:100%;
			position:fixed;
			left:0;
			top:0;
			background: radial-gradient(at center, rgba(20,22,28,0.78), rgba(20,22,28,0.98));
		}
		.lines{
			font-size: 64px;
		}
		.lines b{
			font-size:16px;
		}
		.lines a{
			text-decoration: none;
		}
		.lines span{
			display: inline-block;
			margin:20px;
			width: 85px;
		}
		.slimes{
			width:100%;
			height:100%;
			position: absolute;
			text-align:center;
			z-index:9;
			transition: all 2s ease-in-out;
			-webkit-transition: all 2s ease-in-out; /** Chrome & Safari **/
			-moz-transition: all 2s ease-in-out; /** Firefox **/
			-o-transition: all 2s ease-in-out; /** Opera **/
		}
		.slimes td{
			width: 33%;
		}
		.slimes .second img{
			<?php  
				[$spin, $speed] = get_spin();
			?>
			-webkit-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			-moz-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			animation:spin<?=$spin." ".$speed;?>s linear infinite;
		}
		.slimes .first img{
			<?php  
				[$spin, $speed] = get_spin();
			?>
			-webkit-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			-moz-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			animation:spin<?=$spin." ".$speed;?>s linear infinite;
		}
		.slimes .first .slime{
			<?php  
				[$top, $left, $spin, $speed] = get_movement();
			?>
			padding-top: <?=$top;?>px;
			padding-left: <?=$left;?>px;
			-webkit-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			-moz-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			animation:spin<?=$spin." ".$speed;?>s linear infinite;
			transform-origin: 50% 50%;
		}
		.slimes .second .slime{
			<?php  
				[$top, $left, $spin, $speed] = get_movement();
			?>
			padding-top: <?=$top;?>px;
			padding-left: <?=$left;?>px;
			-webkit-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			-moz-animation:spin<?=$spin." ".$speed;?>s linear infinite;
			animation:spin<?=$spin." ".$speed;?>s linear infinite;
			transform-origin: 50% 50%;
		}
		.slimes .first img{
			padding-left: <?=rand(-150, 150);?>px;
			padding-top: <?=rand(-150, 150);?>px;
		}
		.slimes .second img{
			padding-left: <?=rand(-150, 150);?>px;
			padding-top: <?=rand(-150, 150);?>px;
		}
		@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
		@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
		@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
		@-moz-keyframes spins { 100% { -moz-transform: rotate(-360deg); } }
		@-webkit-keyframes spins { 100% { -webkit-transform: rotate(-360deg); } }
		@keyframes spins { 100% { -webkit-transform: rotate(-360deg); transform:rotate(-360deg); } }

		@media screen and (max-width : 768px) and (orientation : portrait) {
			.slimes {display:none;}  
		}
		
		@keyframes blinking {
		  0% {
			color: #ff0000;
		  }
		  50% {
			color: #ffffff;
		  }
		  100% {
			color: #ff0000;
		  }
		}
		.red {
		  width: 300px;
		  height: 300px;
		  animation: blinking 1s infinite;
		  font-size: 20px;
		}
		

.first, .second{
	position: relative;
}		
.first .wrapper{
	left: 50%;
}		
.second .wrapper{
	right:50%;
}
.wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;
  border-radius: 50%;
  position: absolute;
  top: -218px;
  transform: rotate(180deg) scale(0.3);
  z-index: -1;
}
@media (max-width: 600px) {
  .wrapper {
    transform: scale(0.7) translate(-71%, -71%);
  }
}

.alarm {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;
  width: 400px;
  height: 400px;
  position: relative;
  overflow: hidden;
}
.alarm .bulb {
  width: 180px;
  height: 180px;
  border-top-left-radius: 100px;
  border-top-right-radius: 100px;
  background-color: #ff5722;
  position: relative;
}
.alarm .bulb:after {
  content: "";
  position: absolute;
  width: 40px;
  height: 40px;
  border: 10px solid transparent;
  border-top-color: rgba(255, 255, 255, 0.2);
  top: 15%;
  left: 50%;
  transform: rotate(45deg);
  border-radius: 50%;
}
.alarm .base {
  width: 260px;
  height: 40px;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
  margin-top: -4px;
  background-color: #555;
}
.alarm .bulb,
.alarm .base {
  border: 5px solid #000000;
  box-shadow: inset 15px 5px 0px 1px rgba(0, 0, 0, 0.15);
}
.alarm .light {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0%;
}
.alarm .light span {
  position: absolute;
  width: 0px;
  height: 5px;
  background-color: #e04311;
  border-radius: 10px;
}
.alarm .light span:nth-child(1) {
  left: 10%;
  top: 50%;
  transform-origin: right;
}
.alarm .light span:nth-child(2) {
  transform: rotate(35deg);
  left: 15%;
  top: 25%;
  transform-origin: right;
}
.alarm .light span:nth-child(3) {
  transform: translate(-50%, 0%) rotate(90deg);
  left: 44%;
  top: 15%;
  transform-origin: right;
}
.alarm .light span:nth-child(4) {
  transform: rotate(145deg);
  right: 30%;
  top: 25%;
  transform-origin: right;
}
.alarm .light span:nth-child(5) {
  right: 10%;
  top: 50%;
  transform-origin: left;
}
.alarm .bulb {
  animation: bulb 1s ease infinite;
}
.alarm .light span {
  width: 50px;
}
.alarm .light span:nth-child(1) {
  animation: light1 1s ease infinite;
}
.alarm .light span:nth-child(2) {
  animation: light2 1s ease infinite;
}
.alarm .light span:nth-child(3) {
  animation: light3 1s ease infinite;
}
.alarm .light span:nth-child(4) {
  animation: light4 1s ease infinite;
}
.alarm .light span:nth-child(5) {
  animation: light1 1s ease infinite;
}

@keyframes light1 {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes light2 {
  0% {
    transform: scale(0) rotate(35deg);
  }
  50% {
    transform: scale(1) rotate(35deg);
  }
  100% {
    transform: scale(0) rotate(35deg);
  }
}
@keyframes light3 {
  0% {
    transform: scaleY(0) translate(-50%, 0%) rotate(90deg);
    height: 0px;
  }
  50% {
    transform: scaleY(1) translate(-50%, 0%) rotate(90deg);
    height: 5px;
  }
  100% {
    transform: scaleY(0) translate(-50%, 0%) rotate(90deg);
    height: 0px;
  }
}
@keyframes light4 {
  0% {
    transform: scale(0) rotate(145deg);
  }
  50% {
    transform: scale(1) rotate(145deg);
  }
  100% {
    transform: scale(0) rotate(145deg);
  }
}
@keyframes bulb {
  0% {
    background-color: #500;
    box-shadow: inset 15px 5px 0px 1px rgba(0, 0, 0, 0.15), 0px -10px 30px rgba(255, 87, 34, 0);
  }
  50% {
    background-color: #f11;
    box-shadow: inset 15px 5px 0px 1px rgba(0, 0, 0, 0.15), 0px -10px 30px rgba(255, 87, 34, 0.5);
  }
  100% {
    background-color: #500;
    box-shadow: inset 15px 5px 0px 1px rgba(0, 0, 0, 0.15), 0px -10px 30px rgba(255, 87, 34, 0);
  }
}
	</style>
</head>
<body onload="draw();">
<div id="cover"></div>
<table class="slimes" id="slimes" style="">
	<tr>
		<td class="first">
			<?
			if($copium_overdose){
			?>
			<div class="wrapper">
			  <div class="alarm">
				<div class="light">
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
				<div class="bulb">
				  <div class="eyes">
					<span></span><span></span>
				  </div>
				  <div class="mouth"></div>
				</div>
				<div class="base"></div>
			  </div>
			</div>
			<? } ?>
			<div class="slime">
				<img src="<?=($copium_overdose)? '//enviosity.com/assets/COPIUM.png': '//enviosity.com/assets/slime.png';?>" style="width:150px">
			</div>
		</td>
		<td style="width:150px;">
			<div>
				<a style="display:none">DONOWALL ANDY</a>
			</div>
		</td>
		<td class="second">
			<?			
			if($copium_overdose){
			?>
			<div class="wrapper">
			  <div class="alarm">
				<div class="light">
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
				<div class="bulb">
				  <div class="eyes">
					<span></span><span></span>
				  </div>
				  <div class="mouth"></div>
				</div>
				<div class="base"></div>
			  </div>
			</div>
			<? } ?>
			<div class="slime">
				<img src="<?=($copium_overdose)? '//enviosity.com/assets/COPIUM.png': '//enviosity.com/assets/slime.png';?>" style="width:150px">
			</div>
		</td>
	</tr>
</table>
<canvas id="canvas" width="100%" height="100%"></canvas>
	<div class="container">
		<div id="presentation"><h1 class="banner"><?=$phrase;?></h1></div>
		<div class="main" id="main" style="display:none;">
			<a class="logo"><div></div></a>
			<div class="AYAYA_social">
				<h1><?=$names[$count];?></h1>
				<a>0 days without <?=($copium_overdose)?"COPIUM":"streaming!";?></a><br>
				<a>GFUEL use code "ENVIOSITY" for 10% off!</a>
				<?=($copium_overdose)?"<br><br><a class='red'>WARNING! COPIUM OVERDOSE!</a>":"";?>
				<br><br>
				<div class="lines">
					<span><a class="youtube" href="https://youtube.com/Enviosity" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-youtube"></i>';?><br><b>Youtube</b></a></span>
					<span><a class="twitch" href="https://www.twitch.tv/enviosity" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-twitch"></i>';?><br><b>Twitch</b></a></span>
					<span><a class="youtube" href="https://www.youtube.com/channel/UCc-msH2ut_AGNtkZhLxOLew" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-youtube"></i>';?><br><b>VODs</b></a></span>
				</div>
				<div class="lines">
					<span><a class="twittor" href="https://twitter.com/Enviosity" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-twitter"></i>';?><br><b>Twitter</b></a></span>
					<span><a class="tiktok" href="https://www.tiktok.com/@enviosityclips" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-tiktok"></i>';?><br><b>Tiktok</b></a></span>
					<span><a class="instogram" href="https://instagram.com/enviosity/" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-instagram"></i>';?><br><b>Instagram</b></a></span>
				</div>
				<div class="lines">
					<span><a class="discord" href="https://discord.gg/enviosity" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fab fa-discord"></i>';?><br><b>Discord</b></a></span>
					<span><a class="instogram" href="https://merch.streamelements.com/enviosity" target="_blank"><?=($copium_overdose)? $copium_icon: '<i class="fas fa-tshirt"></i>';?><br><b>Merch</b></a></span>
				</div>
				<br>
				<br>
				<br>
				<br>
				<div class="credits">
				<table align="center">
					<tr>
						<td colspan=5 style="text-align:center"><a style="font-size:12px">VOD CHAT EXPERIENCE SOON <img src="//enviosity.com/assets/COPIUM.png" height="20" width="20" alt="COPIUM" title="COPIUM"></a><br><div style="display:none" id="slime_warning"><a style="font-size:11px">slimes are resource intence!</a> <a style="font-size:10px; text-decoration:underline; cursor:pointer" onclick='enable_slimes()'>Enable them</a></div></td>
					</tr>
				</table>
				
				Images by @fishywishes! Site made by <a>TFBosoN</a> with <?=($copium_overdose)? '<img src="//enviosity.com/assets/COPIUM.png" width="18" alt="COPIUM" title="COPIUM">': '<img src="//enviosity.com/assets/enviLove.png" height="18" width="18" alt="enviLove" title="enviLove">';?></div>
				<div id="popup" onclick="stop();" style="display:none"></div>
			</div>
		</div>
	</div>
<script>

//Close load screen on timeout
function close_p(){
	document.getElementById("main").style.display = 'block';
	document.getElementById("presentation").style.opacity = '0';	
	console.log("closed");
	document.getElementById("main").style.opacity = '1';	
	setTimeout(() => { document.getElementById("presentation").style.display = 'none';}, 1500);
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
data = [
<?php
foreach($bg_images->data as $dat){
	if(!empty($dat->thumbnail_url)){
		$dat->thumbnail_url = str_replace("%{width}", $imgh/9*16, $dat->thumbnail_url);
		$dat->thumbnail_url = str_replace("%{height}", $imgh, $dat->thumbnail_url);
		echo '"'.$dat->thumbnail_url.'",';
	}
}
?>
];
function draw() {
  var k = 0;
  var imgwidth = <?=$imgh/9*16;?>;
  var imgheight = <?=$imgh;?>;
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
</script>
</body>
</html>