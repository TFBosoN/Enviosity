<?php

$names = "GIGACHAD";


//RNG phrases on load screen
$phrase = array("NO MORE<br>F2P DAMAGE!", "\"BEST STREAMER IN THE WORLD!\"<br>--Barack Obama",'<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png" width="160" alt="enviLove" title="enviLove">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/slime.png" width="185" alt="slime" title="slime">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviAyaya.png" width="185" alt="enviAyaya" title="enviAyaya">');
//$phrase = array("0 days without<br><img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/WeirdChamp.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> and <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/monkaTOS.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> in the chat");
$phrase = $phrase[rand(0, count($phrase)-1)];


//Some special site looks depending on name
/*
if($names=="Coderviosity" && !isset($_GET["real_site_pls"])){
	die("<body><h1 style='color:red'>Hello!</h1><blockquote><br>&#171;I do know how to code&#187;</blockquote><figcaption>--Coderviosity, <cite>05/28/2021</cite><br><br><a href='?real_site_pls'>Real site please!</body>");
}
*/

$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/F2P.png";
switch($names){

	case "GIGACHAD":
		$without = "<h2>mode activated</h2>";
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623814460/envi/assets/Gigachad.jpg";
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Gigachadcut.jpg" id="enviChadc"><img src="//res.cloudinary.com/tfboson/image/upload/v1623814460/envi/assets/Gigachad.jpg" id="enviChad" onclick="show_giga();">';
		$phrase_fs = true;
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
	<link rel="stylesheet" href="./assets/main.css">
	<style>
		#enviChad, #enviChadc{
			height: 250%;
			opacity:1;
			transition: all 2s ease-in;
			position:absolute;
			top: 0%;
			left: 50%;
			transform: translate(-30%,-0%);
		}
		@keyframes moveout {
			0% { height:250%; transform: translate(-30%,-0%);}
			10% { height:250%; transform: translate(-30%,-0%);}
			100% { height:100%; transform: translate(-50%,-0%);}
		}
		#enviChad{
			z-index: 60;
		}
		#enviChadc{
			z-index: 61;
		}
		#gigaBG{
			background: url(./assets/abyss.webp), 100%;
			background-position: center, center;
			background-size: cover;
			z-index: 59;
			position:absolute;
			left:0;
			top:0;
			width:100%;
			height:100%;
			transition: all 2s ease-in;
		}
		#presentation{
			transition: all 2s ease-in;
			background: linear-gradient(170deg, rgb(0, 0, 0) 0%, rgb(0, 0, 0) 33%, rgb(1, 20, 18) 55%, rgb(5, 41, 39) 65%, rgb(6, 73, 66) 80%, rgb(5, 75, 67) 100%);
		}
		#dialog{
			position:fixed;
			width: 100%;
			height: 100%;
			z-index: 90;
			cursor: pointer;
		}
		#enviChadcuts img{
			height: 500px;
			transition: all 1s ease-in;
		}
		#enviChadcutseyes img{
			height: 500px;
			transition: all 1s ease-in;
		}
		#glogin{
			background:  url(./assets/genshin_login.png), 100%;
			background-position: center, center;
			background-size: cover;
			z-index: 100;
			position: fixed;
			width: 100%;
			height: 100%;
			transition: all 0.4s ease-in;
			cursor: pointer;
		}
		#gload{
			background:  url(./assets/loading.webp), 100%;
			background-position: center, center;
			background-size: cover;
			z-index: 99;
			position: fixed;
			width: 100%;
			height: 100%;
			transition: all 1s ease-in;
			cursor: pointer;
		}
		@font-face {
			font-family: 'genshin';
			src: url('./assets/genshin.ttf'); 
		}
		#dialog_box{
			display:none;
			opacity:0;
			height:200px;
			position: fixed;
			bottom:0;
			width:100%;
			Background: rgba(70, 50, 50, 0.3);
			border: 2px solid rgba(20, 10, 10, 0.3);
			z-index: 101;
			text-align: center;
			font-family: genshin;
			cursor: pointer;
		}
		#name{
			font-size: 40px;
			font-weight: bold;
			font-family: genshin;
			color: #fdbc06;
			border-bottom: 2px solid rgba(253, 188, 6, 0.7);
			width: 420px;
			position: absolute;
			left: 50%;
			transform: translate(-50%);
		}
		#dtext{
			margin: 50px auto;
			white-space: nowrap;
			overflow: hidden;
			font-family: genshin;
			color: #fff;
			font-size: 36px;
			text-align: center;
			position: absolute;
			left: 50%;
			transform: translate(-50%,0);
		}
		@keyframes typing {
		  from { width: 0 }
		  to { width: 100% }
		}
		#Pepega, #sheeshf{
			display:none;
			margin-top: 100px;
			height: 200px;
			animation: typing 1s infinite linear;
			animation-direction: alternate-reverse;
		}
		#BOPER{
			animation: typing 1s infinite linear;
			animation-direction: alternate-reverse;
		}
		#enviWall, #monkaW, #enviEZ{
			margin-top: 100px;
			height: 200px;
		}
		@keyframes typing {
		  from { transform: rotate(-20deg) }
		  to { transform: rotate(20deg) }
		}
		#Pepega img, #enviWall img, #sheeshf img, #monkaW img, #enviEZ img{
			height:100%;
		}
		#resin{
			font-family: genshin;
			position: fixed;
			top:5px;
			right: 50px;
			z-index: 98;
			font-size: 36px;
			font-weight: bold;
		}
		#resin img{
			width:48px;
			vertical-align: middle;
		}
		#enviWall{
			z-index: 98;
		}
		#lightning, #lightning img{
			position:fixed;
			top:0;
			left:0;
			width:100%;
			height:100%;
			z-index: 102;
		}
		#prestory{
			z-index: 200;
			width: 100%;
			height:100%;
			position: fixed;
			top:0;
			left:0;
			background: black;
			opacity: 1;
			transition: all 1s ease-in;
			cursor: pointer;
		}
		@keyframes spin {
		  from { transform: rotate(0deg) }
		  to { transform: rotate(360deg) }
		}
		
		#wave{
			display:none;
			width:100px;
			position: absolute;
			top:0%;
			left:42%;
			transform: translate(-50%,50%);
		}
		#story{
			color: white;
			position: absolute;
			bottom:50px;
			left:50%;
			transform: translate(-50%,-50%);
			font-size: 32px;
		}
	</style>
</head>
<body onload="draw();">
	<div id="cover"></div>
	<canvas id="canvas" width="100%" height="100%"></canvas>
	<div class="container">
		<div id="prestory" onclick="ramble()" style="display:none;">
			<div style="position:absolute; left:0; top:0; width:100%; height:100%; transform: translate(0, 38%);">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846747/envi/assets/particle.jpg" style="width:150px; border-radius:50%;">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/wave.gif" id="wave">
			</div>
			<div id="story">[click]</div>
		</div>
		<div id="dialog" onclick="con_dia()"><div id="Pepega"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Pepega.png"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846803/envi/assets/mega.gif"></div><div id="enviWall" style="display:none"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/enviWall.png"></div><div id="enviEZ" style="display:none"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/enviEZ.png"><img id="BOPER" src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/BOP.png"></div><div id="sheeshf" style="display:none"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/sheeshf.png"></div><div id="monkaW" style="display:none"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/monkaW.png"></div><div id="enviChadcuts" style="display:none; opacity: 0"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Gigachadcuts.png"></div><div id="lightning" style="display:none;"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/lightning_strike.gif"></div><div id="enviChadcutseyes" style="display:none;"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Gigachadcutseyes.png"></div></div>
		<div id="glogin" onclick="con_dia()"></div>
		<div id="gload" onclick="con_dia()"></div>
		<div id="dialog_box"  onclick="con_dia()"><div id="name">Enviosity</div><div id="dtext"><p></p></div></div>
		<div id="presentation"><h1 class="banner" style="<?=($phrase_fs)?"height:100%":"";?>"><?=$phrase;?></h1></div>
		<div id="gigaBG"></div>
		<div id="resin"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/resin.webp"> 160/160</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	var dia_stage = 0;
	var captionLength = 0;
	var caption = '';
	var started = false;
	function ramble(){
		if(!started){
			started = true;
			$("#prestory img").css("animation", "spin 10s linear infinite");
			setTimeout(() => { 
				$("#wave").css("display", "block"); 
				types("Ello! Hope you enjoy this quick thing that I've made :)", 0);
				setTimeout(() => {
					$("#wave").css("display", "none"); 
					setTimeout(() => {
						types("No sound :(<br>enviFlower in chat", 0);
						setTimeout(() => {
							$("#prestory").css("opacity", "0"); 
							setTimeout(() => {
								$("#prestory").css("display", "none"); 
							}, 1000);
						}, 2500);
					}, 1500);
				}, 2000);
			}, 1000);
		}
	}
	
	function types(caption, captionLength = 0) {
		captionLength = parseInt(captionLength);
		$('#story').html(caption.substr(0, captionLength++));
		if(captionLength < caption.length+1) {
			setTimeout('types("'+caption+'", "'+captionLength+'")', 50);
		} else {
			captionLength = 0;
			caption = '';
		}
	}
	function type(caption, captionLength = 0) {
		captionLength = parseInt(captionLength);
		$('#dtext p').html(caption.substr(0, captionLength++));
		if(captionLength < caption.length+1) {
			setTimeout('type("'+caption+'", "'+captionLength+'")', 50);
		} else {
			captionLength = 0;
			caption = '';
		}
	}
	function con_dia(){
		console.log(dia_stage);
		switch(dia_stage){
			//logins screen
			case 0:
				document.getElementById("glogin").style.transform = 'scale(10)';
				document.getElementById("glogin").style.opacity = '0';
				setTimeout(() => { document.getElementById("glogin").style.display = 'none'; }, 150);
				
				setTimeout(() => { document.getElementById("gload").style.opacity = '0'; 
					setTimeout(() => { document.getElementById("gload").style.display = 'none'; 
						setTimeout(() => { document.getElementById("gigaBG").style.filter = "blur(20px)"; document.getElementById("enviChadcuts").style.display = 'block';document.getElementById("enviChadcuts").style.opacity = '1'; 
							setTimeout(() => { document.getElementById("dialog_box").style.display = 'block'; document.getElementById("dialog_box").style.opacity = '1'; type("Ahhh, what a beautiful day!", 0);}, 500);}, 500);}, 1000); }, 1800);
			break;
			case 1:
				type("Time to farm my daily crys..", 0);
			break;
			case 2:
				$("#name").html("???");
				type("Mr. Stripper!", 0);
			break;
			case 3:
				$("#resin").css("display", "none");
				$("#Pepega").css("display", "block");
				$("#enviChadcuts").css("display", "none");
				type("Mr. Stripper! Do you kn..", 0);
				$("#name").html("Menga Reader");
			break;
			case 4:
				$("#resin").css("display", "block");
				$("#Pepega").css("display", "none");
				$("#enviChadcuts").css("display", "block");
				$("#name").html("Enviosity");
				type(" crys..tals. Oh my god!  I'm ..", 0);
			break;
			case 5:
				type("How did I get capped on resin?!", 0);
			break;
			case 6:
				type("I thought I did math yesterday..", 0);
			break;
			case 7:
				$("#enviWall").css("display", "block");
				type("Ahh, what a fine taste of brick", 0);
				$("#name").html("Menga Reader");
				$("#resin").css("display", "none");
				$("#enviChadcuts").css("display", "none");
			break;
			case 8:
				$("#enviWall").css("display", "none");
				$("#Pepega").css("display", "block");
				$("#name").html("Menga Reader");
				type("HAVE YOU SEEN THE NEW ABYSS? IT'S HARD", 0);
			break;
			case 9:
				$("#Pepega").css("display", "none");
				$("#sheeshf").css("display", "block");
				$("#name").html("Menga Reader");
				type("You know, I cleared it myself tho..", 0);
			break;
			case 10:
				type("So you NEED to take THIS and THAT and THIS...", 0);
			break;
			case 11:
				$("#sheeshf").css("display", "none");
				$("#enviEZ").css("display", "block");
				$("#name").html("QueenQ");
				type("BOINK", 0);
			break;
			case 12:
				$("#enviEZ").css("display", "none");
				$("#monkaW").css("display", "block");
				type("Oh no, it's too late", 0);
			break;
			case 13:
				type("Hide, chat!", 0);
			break;
			case 14:
				$("#name").html("Enviosity");
				$("#monkaW").css("display", "none");
				$("#enviChadcutseyes").css("display", "block");
				type("Do I smell FLEX?!?!!", 0);
			break;
			case 15:
				type("TIME TO TAKE THE SHACKLES OFF", 0);
			break;
			case 16:
				type("BEHOLD THE SUPERIOR F2P PLAYER", 0);
			break;
			case 17:
				$("#gigaBG").css("background", "black");
				$("#enviChadcutseyes").css("display", "none");
				$("#dialog_box").css("display", "none");
				$("#lightning").css("display", "block");
				setTimeout(() => { 
					$("#gigaBG").css("display", "none");
					$("#enviChadc").css("display", "block");
				}, 200);
				setTimeout(() => { show_giga(); }, 1000);
			break;
		}
		dia_stage++;
	}
	function show_giga(){
		console.log("clicked");
		
		$("#lightning").css("display", "none");
		$("#dialog").css("display", "none");
		document.getElementById("enviChad").style.animation = 'moveout 3s ease-out forwards';
		document.getElementById("enviChadc").style.animation = 'moveout 3s ease-out forwards';
		setInterval(function(){
			document.getElementById("enviChadc").style.opacity = '0';
			document.getElementById("gigaBG").style.opacity = '0';
			document.getElementById("presentation").style.transition = 'all 0.5s ease';
		},800);
		setTimeout(() => { close_p(); }, 3500);
	}
	</script>
	<script src='./assets/main.js'></script>
</body>
</html>
