<html>
<head>
	<title>Enviosity</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta charset="utf-8">
	<meta name="description" CONTENT="Enviosity's f2p website">
	<meta name="keywords" content="enviosity, f2p, gamer, streamer, youtube, social, genshin, impact, genshin impact, slipper">
	<link rel="shortcut icon" href="./enviNotes.ico" type="image/x-icon">
	<!-- Fontawesome icons -->
	<link rel="stylesheet" href="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/main.css">
	<style>
		body{
			margin:0;
			padding: 0;
			color:white;
			text-align: center;
			background: black;
		}
		#bg, #scene{
			position:fixed;
			left:0;
			top:0;
			width: 100%;
			height: 100%;
			z-index:1;
			background-repeat: no-repeat;
			background-position: center;
			display:none;
		}
		#scene{
			z-index: 99;
		}
		#bg{
			background-size: 100% auto;
			filter: blur(20px);
		}
		#dialog{
			position:fixed;
			width: 100%;
			height: 100%;
			z-index: 90;
			cursor: pointer;
			display:none;
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
			font-size: 30px;
		}
		#prestory div{
			position:absolute;
			bottom:50px;
			left:50%;
			transform: translate(-50%,0);
		}
		#house, #hall, #sign, #strim, #crowd, #table, #washing_bg, #fishy_eat, #backd, #hall2, #hydrated{
			background-position: center, center;
			background-size: cover;
			position: fixed;
			width: 100%;
			height: 100%;
			cursor: pointer;
			transition: transform 6s ease-in-out, opacity 1s ease-in-out;
			display:none;
			opacity:1;
		}
		#house{
			background:  url(https://cdn.discordapp.com/attachments/860285417181806592/861075891325108294/image0.jpg), 100%;
			display:block;
			z-index: 100;
		}
		#hall{
			background:  url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/hall.jpg), 100%;
			z-index: 99;
		}
		#sign{
			background:  url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/sign.jpg), 100%;
			z-index: 98;
		}
		#strim{
			background:  url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim.jpg), 100%;
			z-index: 94;
		}
		#crowd{
			background:  url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/crowd.png), 100%;
			z-index: 97;
			animation-direction: alternate-reverse;
		}
		#table{
			background:  url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/table.png), 100%;
			z-index: 96;
		}
		#Envi{
			z-index: 95;
			position: fixed;
			left:0;
			top:0;
			height: 100%;
			width:100%;
			display: none;
		}
		#Envi img{
			position: absolute;
			left:50%;
			bottom:0%;
			transform: translate(-50%, 0%);
			height: 200px;
			transition: transform 6s ease-in-out, bottom 7s ease-in-out;
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
		#presentation{
			transition: all 2s ease-in;
			background: linear-gradient(170deg, rgb(0, 0, 0) 0%, rgb(0, 0, 0) 33%, rgb(1, 20, 18) 55%, rgb(5, 41, 39) 65%, rgb(6, 73, 66) 80%, rgb(5, 75, 67) 100%);
			display:none;
		}
		#dialog{
			position:fixed;
			width: 100%;
			height: 100%;
			z-index: 101;
			cursor: pointer;
			display:none;
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
		#Jebaited, #Washing, #Mils, #KEKW, #YEP, #enviWhale, #peepoWTF, #peepoRiot, #KEKWa{
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-60%);
			display:none;
			height: 250px;
		}
		
		#Washing, #enviWhale{
			left: 40%;
			top: 25%;
		}
		#enviWhale{
			animation: spin 1s infinite linear;
		}
		#Mils{
			height: 200px;
		}
		#Jebaited img, #Washing img, #Mils img, #KEKW img, #YEP img, #enviWhale img, #peepoWTF img, #peepoRiot img, #KEKWa img{
			height:100%;
		}
		#Washing{
			animation: waiving 0.05s infinite linear;
			animation-direction: alternate-reverse;
			height:600px;
		}
		@keyframes spin {
		  from { transform: rotate(0deg) }
		  to { transform: rotate(359deg) }
		}
		@keyframes waiving {
		  from { transform: rotate(-10deg) }
		  to { transform: rotate(10deg) }
		}
		@keyframes crowd {
		  from { transform: translate(0,10px) }
		  to { transform: translate(5px,0px) }
		}
		#washing_bg{
			background: url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/washing_bg.jpg), 100%;
			z-index: 97;
		}
		#fishy_eat{
			background: url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/fishy_eat.jpg), 100%;
			background-position: bottom;
			z-index: 97;
		}
		#backd{
			background: url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/backd.jpg), 100%;
			background-position: bottom;
			z-index: 97;
		}
		#hall2{
			background: url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/hall2.jpg), 100%;
			z-index: 97;
		}
		#hydrated{
			background: url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/hydrated.jpg), 100%;
			z-index: 97;
		}
		#book{
			position:fixed;
			left:0;
			top:0;
			width: 100%;
			height: 100%;
			background-repeat: no-repeat;
			background-position: center;
			background-image: url(./assets/book.png);
			background-size: auto 100%;
			z-index: 200;
		}
		
.flip-card {
  perspective: 1000px;
  z-index: 300;
  display:none;
  width: fit-content;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.flip-card:hover .flip-card-inner {
  transform-origin: 0 0;
  transform: rotateY(-180deg);
}

.flip-card-front,
.flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: #bbb;
  color: black;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(-180deg);
}
	</style>
	<link as="fetch" rel="preload" href="https://cdn.discordapp.com/attachments/860285417181806592/861075891325108294/image0.jpg"/>
</head>
<body>
	<div class="container">
		<div id="prestory" onclick="con_dia()" style="display:block">
			<div id="story">This story contains amazing drawings<br>made by @peachesforbreakfast<br><br>[begin]</div>
		</div>
		<div id="scene"></div>
		<div id="dialog" onclick="con_dia()">
			<div id="Jebaited" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/Jebaited.png"></div>
			<div id="Washing" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/Washing.png"></div>
			<div id="Mils" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/mils.png"></div>
			<div id="KEKW" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/KEKW.png"></div>
			<div id="YEP" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/YEP.png"></div>
			<div id="enviWhale" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/enviWhale.png"></div>
			<div id="peepoWTF" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/peepoWTF.png"></div>
			<div id="peepoRiot" class="actor"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/peepoRiot.gif"></div>
			<div id="KEKWa" class="actor"><img src="./assets/KEKWa.webp"></div>
		</div>
		<div id="bg"></div>
		<div class="flip-card">
		  <div class="flip-card-inner">
			<div class="flip-card-front" id="book">
			</div>
			<div class="flip-card-back">
			  <h1>John Doe</h1>
			  <p>Architect & Engineer</p>
			  <p>We love that guy</p>
			</div>
		  </div>
		</div>
		<div id="Envi"><img src="https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/Envi.png"></div>
		<div id="dialog_box" onclick="con_dia()"><div id="name">Enviosity</div><div id="dtext"><p></p></div></div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	var dia_stage = 0;
	var captionLength = 0;
	var caption = '';
	var started = false;
	function smooth_mute(audio, audio2, volume, volume2){
		console.log(volume);
		if(volume>0 && volume>0.05){
			volume = volume - 0.05;
			volume2 = volume2 + 0.008;
			audio.volume = volume;
			audio2.volume = volume2;
			setTimeout(() => {
				smooth_mute(audio, audio2, volume, volume2);
			}, 120);
		}else{
			audio.volume = 0;
		}
	}
	var audio = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280018/envi/muffin/assets/sneaking.mp3");
	var audio2 = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280015/envi/muffin/assets/bye.mp3");
	var door = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280014/envi/muffin/assets/door.ogg");
	var washing = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280020/envi/muffin/assets/washing.ogg");
	var crowd = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280015/envi/muffin/assets/crowd.mp3");
	var water = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280021/envi/muffin/assets/water.mp3");
	var water2 = new Audio("https://res.cloudinary.com/tfboson/video/upload/v1624280021/envi/muffin/assets/water2.mp3");
	function loadAudio(url){
		var audio = new Audio();
		audio.src = url;
		audio.preload = "auto";
		return audio;
	}
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
		if(allow_input && finished_typing || dia_stage==29){
			allow_input = false;
			finished_typing = false;
			console.log(dia_stage);
			text = "";
			texts = "";
			reader = "Brian";
			$(".actor").css("display", "none"); 
			switch(dia_stage){
				case 0:
					$("#prestory").css("display", "none");
					$(".flip-card").css("display", "block");
					bg = "";
				break;
				case 1:
					//bg = "https://cdn.discordapp.com/attachments/860285417181806592/861075891325108294/image0.jpg";
					$("#name").html("Enviosity");
					text = "Alright boys! Take it easy!";
				break;
				case 2:
					text = "Homework chat! Give someone a flower today";
				break;
				case 3:
					text = "Ahhhhh! I forgot to tell you guys something important...";
				break;
				case 4:
					$("#name").html("Chat");
					$("#Jebaited").css("display", "block");
					text = "...";
				break;
				case 5:
					$("#name").html("Enviosity");
					$("#table").css("background", "url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/table2.png), 100%");
					text = "*stops stream*";
					texts = "...";
					audio2.pause();
				break;
				case 6:
					text = "haHAA! too EZ everytime";
					texts = "ahaa! too easy every time!";
				break;
				case 7:
					text = "Time to do my home stuff";
					$("#strim").css("transform", "scale(1) translate(0, 0)");
					$("#crowd").css("transform", "scale(1) translate(0, 0)");
					$("#table").css("transform", "scale(1) translate(0, 0)");
					$("#Envi img").css("transform", "scale(0.6) translate(0, 550px)");		
				break;
				case 8:
					$("#strim").css("background", "url(https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim2.jpg), 100%");
					$("#Envi").css("display", "none");
					door.play();
					$("#name").html("...");
					text = "<continue>";
					texts = "...";
				break;
				case 9:
					$("#washing_bg").css("display", "block");
					$("#Washing").css("display", "block");
					$("#strim").css("display", "none");
					$("#crowd").css("display", "none");
					$("#table").css("display", "none");
					washing.volume = 0.4;
					washing.currentTime = 2;
					washing.play();
					text = "<continue>";
					texts = "...";
				break;
				case 10:
					$("#washing_bg").css("display", "none");
					$("#Washing").css("display", "none");
					washing.pause();
					$("#fishy_eat").css("display", "block");
					$("#name").html("FishyWishies");
					text = "Nom";
					reader = "Emma";
					crowd.volume = 0.1;
					crowd.play();
				break;
				case 11:
					$("#fishy_eat").css("display", "none");
					$("#backd").css("display", "block");
					text = "What is that sound?";
					$("#name").html("Enviosity");
					crowd.volume = 0.25;
					crowd.play();
				break;
				case 12:
					$("#backd").css("display", "none");
					$("#hall2").css("display", "block");
					text = "It's comming from strim room..";
					texts = "It's cumming from stream room!";
					crowd.volume = 0.28;
				break;
				case 13:
					$("#hall2").css("display", "none");
					$("#table2").css("display", "block");
					$("#crowd").css("display", "block");
					$("#strim").css("display", "block");
					$("#crowd").css("animation", "crowd 0.2s linear infinite");
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim3.jpg'), 100%");
					text = "WHAT'S GOING ON HERE?! IT'S BEEN AN HOUR SINCE I ENDED STREAM!";
					crowd.volume = 0.4;
				break;
				case 14:
					crowd.volume = 0.05;
					$("#name").html("we1rdmuff1n");
					$("#Mils").css("display", "block");
					text = "Mr. Streamer what shall I do with my 3M Copium Coins?";
					texts = "Mr. Streamer! What shall I do with my 3 million Copium Coins?";
					reader = "Russell";
				break;
				case 15:
					$("#KEKW").css("display", "block");
					$("#name").html("Enviosity");
					text = "Dump them in Hydrate KEKW";
				break;
				case 16:
					$("#YEP").css("display", "block");
					$("#name").html("we1rdmuff1n");
					text = "OK";
					texts = "Okay!";
					reader = "Russell";
				break;
				case 17:
					water.volume = 0.2;
					water.loop = true;
					water.play();
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim4.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 18:
					water.volume = 0.25;
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim6.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 19:
					water.volume = 0.3;
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim8.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 20:
					water.pause();
					$("#YEP").css("display", "block");
					$("#name").html("we1rdmuff1n");
					text = "Going good!";
					reader = "Russell";
				break;
				case 21:
					$("#name").html("Enviosity");
					text = "This mad lad";
				break;
				case 22:
					$("#name").html("Enviosity");
					text = "Time to add a channel redemption for 3M now that he used up all his points";
					texts = "Time to add a channel redemption for 3 million now that we1rdmuff1n used up all his points";
				break;
				case 23:
					$("#peepoWTF").css("display", "block");
					$("#name").html("we1rdmuff1n");
					text = "Fuk it, stay hydrate Envi";
					reader = "Russell";
				break;
				case 24:
					water2.volume = 0.5;
					water2.play();
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim9.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 25:
					water2.volume = 0.6;
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim10.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 26:
					$("#crowd").css("display", "none");
					water2.volume = 0.2;
					$("#strim").css("background", "url('https://res.cloudinary.com/tfboson/image/upload/v1624280022/envi/muffin/assets/strim11.jpg'), 100%");
					setTimeout(() => {
						con_dia();
					}, 1000);
				break;
				case 27:
					$("#enviWhale").css("display", "block");
					$("#name").html("Chat");
					text = "WEEEEEEEE";
				break;
				case 28:
					$("#peepoRiot").css("display", "block");
					text = "WHERE IS MY BOAT peepoTub";
				break;
				case 29:
					$("#strim").css("display", "none");
					$("#hydrated").css("display", "block");
					water2.pause();
					$("#name").html("Enviosity");
					text = "NO MORE HYDRATES PLEASE!";
				break;
				case 30:
					$("#KEKWa").css("display", "block");
					$("#name").html("Enviosity");
					text = "I'VE LOST FULL CONTROL OF MY OFFLINE CHAT NOW";
				break;
				case 31:
					text = "The End!";
				break;
			}
			$("#scene").css("background-image", "url('"+bg+"')");
			$("#bg").css("background-image", "url('"+bg+"')");
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
