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
	<link rel="shortcut icon" href="./enviNotes.ico" type="image/x-icon">
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
			display:none;
		}
		#presentation{
			transition: all 2s ease-in;
			background: linear-gradient(170deg, rgb(0, 0, 0) 0%, rgb(0, 0, 0) 33%, rgb(1, 20, 18) 55%, rgb(5, 41, 39) 65%, rgb(6, 73, 66) 80%, rgb(5, 75, 67) 100%);
			display:none;
		}
		#dialog{
			position:fixed;
			width: 100%;
			height: 100%;
			z-index: 90;
			cursor: pointer;
			display:none;
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
			display:none;
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
		#enviChadcuts{
			opacity: 0;
		}
		#enviChadcuts, #enviChadcutseyes, #Gigachad_cut{
			height: 420px;
			transition: all 1s ease-in;
		}
		#enviWall, #monkaW, #enviEZ, #enviLate, #Kappa, #Pepega, #WeirdChamp, #sheeshf{
			height: 300px;
			transition: all 1s ease-in;
		}
		
		#enviChadcuts img, #enviChadcutseyes img, #Gigachad_cut img, #enviLate img, #Kappa img, #WeirdChamp img{
			animation: still 1s infinite linear;
			animation-direction: alternate-reverse;
		}
		@keyframes still {
		  from { transform: rotate(-4deg) }
		  to { transform: rotate(4deg) }
		}
		#Pepega div, #sheeshf img{
			animation: leaning 1s infinite linear;
			animation-direction: alternate-reverse;
		}
		@keyframes leaning {
		  from { transform: rotate(-20deg) }
		  to { transform: rotate(20deg) }
		}
		#BOPER{
			animation: waiving 0.2s infinite linear;
			animation-direction: alternate-reverse;
		}
		@keyframes waiving {
		  from { transform: rotate(-20deg) }
		  to { transform: rotate(60deg) }
		}
		#enviChadcuts, #enviChadcutseyes, #enviWall, #monkaW, #enviEZ, #enviLate, #Kappa, #Pepega, #WeirdChamp, #sheeshf{
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-60%);
			display:none;
		}
		
		#enviChadcuts img, #enviChadcutseyes img, #Pepega img, #enviWall img, #sheeshf img, #monkaW img, #enviEZ img, #enviLate img, #Kappa img, #WeirdChamp img{
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
			display:none;
		}
		#resin img{
			width:48px;
			vertical-align: middle;
		}
		#enviWall{
			z-index: 98;
		}
		#lightning{
			display:none;
		}
		#lightning img{
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
<body>
	<div class="container">
		<div id="prestory" onclick="ramble()">
			<div style="position:absolute; left:0; top:0; width:100%; height:100%; transform: translate(0, 38%);">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846747/envi/assets/particle.jpg" style="width:150px; border-radius:50%;">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/wave.gif" id="wave">
			</div>
			<div id="story">[begin]</div>
		</div>
		<div id="dialog" onclick="con_dia()">
			<div id="Pepega" class="actor"><div style="width:800px;"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Pepega.png"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846803/envi/assets/mega.gif"></div></div>
			<div id="enviWall" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/enviWall.png"></div>
			<div id="enviEZ" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/enviEZ.png"><img id="BOPER" src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/BOP.png"></div>
			<div id="sheeshf" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/sheeshf.png"></div>
			<div id="monkaW" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/monkaW.png"></div>
			<div id="enviChadcuts" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Gigachadcuts.png"></div>
			<div id="enviChadcutseyes" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/Gigachadcutseyes.png"></div>
			<div id="enviLate" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623948014/envi/assets/enviLate.png"></div>
			<div id="WeirdChamp" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/WeirdChamp.png"></div>
			<div id="Kappa" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623952170/envi/assets/Kappa.png"></div>
			<div id="Gigachad_cut" class="actor"><img src="//res.cloudinary.com/tfboson/image/upload/v1623959384/envi/assets/Gigachad_cut.png"></div>
		</div>
		<div id="glogin" onclick="con_dia(); play_login()"></div>
		<div id="gload"></div>
		<div id="lightning"><img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/lightning_strike.gif"></div>
		<div id="dialog_box" onclick="con_dia()"><div id="name">Enviosity</div><div id="dtext"><p></p></div></div>
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
				types("Hello! This will be a multi-part story!", 0);
				play_sound("Hello! This will be a multi-part story!", "Justin");
				setTimeout(() => {
					$("#wave").css("display", "none"); 
					setTimeout(() => {
						types("Brian and special sound effects used!", 0);
						play_sound("Brian and special sound effects used!", "Justin");
						setTimeout(() => {
							$("#prestory").css("opacity", "0"); 
							types("Enjoy!", 0);
							play_sound("Enjoy!", "Justin");
							setTimeout(() => {
								$("#prestory").css("display", "none"); 
							}, 1000);
						}, 2500);
					}, 1500);
				}, 2000);
			}, 1000);
		}
	}
	function loadAudio(url){
		var audio = new Audio();
		audio.src = url;
		audio.preload = "auto";
		return audio;
	  }
	var login_a = loadAudio("https://res.cloudinary.com/tfboson/video/upload/v1623956911/envi/assets/login.wav");
	var triggered = loadAudio("https://res.cloudinary.com/tfboson/video/upload/v1623958470/envi/assets/triggered.mp3");
	var transformation = loadAudio("https://res.cloudinary.com/tfboson/video/upload/v1623960042/envi/assets/8281.mp3");
	var lightning = loadAudio("https://res.cloudinary.com/tfboson/video/upload/v1623960307/envi/assets/lightning.mp3");
	function play_login(){
		login_a.play();
	}
	function play_triggered(vol){
		triggered.volume = vol;
		triggered.play();
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
			finished_typing = true;
		}
	}
	allow_input = true;
	finished_typing = true;
	function con_dia(){
		if(allow_input && finished_typing){
			allow_input = false;
			finished_typing = false;
			console.log(dia_stage);
			text = "";
			texts = "";
			reader = "Brian";
			$(".actor").css("display", "none"); 
			switch(dia_stage){
				//logins screen
				case 0:
					$("#glogin").css("transform", "scale(10)");
					$("#glogin").css("opacity", "0");
					$("#gload").css("display", "block");
					setTimeout(() => { 
						$("#glogin").css("display", "none"); 
					}, 150);
					
					setTimeout(() => { 
						$("#gigaBG").css("display", "block");
						$("#resin").css("display", "block");
						$("#dialog").css("display", "block");
						$("#gload").css("opacity", "0");
						setTimeout(() => { 
							$("#gload").css("display", "none");
							$("#enviChadcuts").css("opacity", "0");
							setTimeout(() => {
								$("#gigaBG").css("filter", "blur(20px)");
								$("#enviChadcuts").css("display", "block");
								$("#enviChadcuts").css("opacity", "1");
								setTimeout(() => { 
									$("#dialog_box").css("display", "block");
									$("#dialog_box").css("opacity", "1");
									text = "Ahhh, what a beautiful day in Genshin!";
									play_sound(text);
									type(text, 0);
								}, 500);
							}, 1000);
						}, 1000);
					}, 1800);
				break;
				case 1:
					$("#resin").css("display", "block");
					$("#enviLate").css("display", "block");
					$("#name").html("Chat");
					text = "Late again Mr. Lateosity!";
					reader = "Emma";
				break;
				case 2:
					$("#enviChadcuts").css("display", "block");
					$("#name").html("Enviosity");
					text = "What do you mean Chat! I'm never late!";
				break;
				case 3:
					$("#Kappa").css("display", "block");
					$("#name").html("Chat");
					text = "...";
				break;
				case 4:
					$("#enviChadcuts").css("display", "block");
					$("#name").html("Enviosity");
					text = "Anyways. Time to buy some water and farm my daily crystals!";
				break;
				case 5:
					$("#WeirdChamp").css("display", "block");
					$("#name").html("Chat");
					text = "WeirdChamp CAPPED";
					reader = "Emma";
				break;
				case 6:
					$("#name").html("Someone in Chat");
					text = "Mr. Stripper!";
					reader = "Russell";
				break;
				case 7:
					$("#Pepega").css("display", "block");
					text = "Mr. Slipper! Do you know that..";
					reader = "Russell";
					$("#name").html("Menga Reader");
				break;
				case 8:
					$("#enviChadcuts").css("display", "block");
					$("#name").html("Enviosity");
					text = "Oh my god!!  I'm ..";
				break;
				case 9:
					$("#enviChadcuts").css("display", "block");
					text = "How did I get capped on resin?!";
				break;
				case 10:
					$("#enviChadcuts").css("display", "block");
					text = "I thought I did my math yesterday..";
				break;
				case 11:
					$("#enviWall").css("display", "block");
					text = "Ahh, what a fine taste of brick";
					reader = "Russell";
					$("#name").html("Menga Reader");
				break;
				case 8:
					$("#enviChadcuts").css("display", "block");
					$("#name").html("Enviosity");
					text = "Oh my god!!  I'm ..";
				break;
				case 12:
					$("#resin").css("display", "none");
					$("#Pepega").css("display", "block");
					text = "HAVE YOU SEEN THE NEW ABYSS??? IT'S HARD!!";
					reader = "Russell";
				break;
				case 13:
					$("#sheeshf").css("display", "block");
					text = "You know, I cleared it myself tho..";
					reader = "Russell";
				break;
				case 14:
					$("#Pepega").css("display", "block");
					text = "So you NEED to take THIS and THAT and THIS...";
					reader = "Russell";
				break;
				case 15:
					$("#WeirdChamp").css("display", "block");
					$("#name").html("Chat");
					text = "WTF FLEXER";
					reader = "Emma";
				break;
				case 16:
					$("#enviEZ").css("display", "block");
					$("#name").html("QueenQ");
					text = "BOINK";
					reader = "Salli";
				break;
				case 17:
					$("#monkaW").css("display", "block");
					text = "Oh no, it's too late";
					reader = "Salli";
					play_triggered(0.02);
				break;
				case 18:
					$("#monkaW").css("display", "block");
					text = "Hide chat!";
					reader = "Salli";
				break;
				case 19:
					$("#name").html("Enviosity");
					$("#enviChadcutseyes").css("display", "block");
					text = "Do I smell FLEX?!?!!";
					texts = "Do I smell, FLEX?!?!!";
					play_triggered(0.04);
				break;
				case 20:
					$("#enviChadcutseyes").css("display", "block");
					text = "TIME TO TAKE THE SHACKLES OFF";
				break;
				case 21:
					$("#enviChadcutseyes").css("display", "block");
					text = "BEHOLD THE SUPERIOR F2P PLAYER";
				break;
				case 22:
					transformation.play();
					lightning.play();
					$("#gigaBG").css("background", "black");
					$("#lightning").css("opacity", "1");
					$("#lightning").css("display", "block");
					$("#dialog_box").css("display", "none");
					$("#presentation").css("display", "block");
					setTimeout(() => { 
						$("#gigaBG").css("display", "none");
						$("#enviChadc").css("display", "block");
						$("#lightning").css("opacity", "0");
						setTimeout(() => { show_giga(); }, 1000);
					}, 300);
				break;
			}
			texts = texts? texts: text;
			play_sound(texts, reader);
			type(text, 0);
			dia_stage++;
			allow_input = true;
		}
	}
	function play_sound(text, whom = "Brian"){
		var audio = new Audio("https://api.streamelements.com/kappa/v2/speech?voice="+whom+"&text="+encodeURIComponent(text.trim()));
		audio.play();
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
		setTimeout(() => {
			$("#dialog_box").css("display", "block");
			type("To be continued..", 0);
		}, 1000);
		
	}
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
	</script>
</body>
</html>
