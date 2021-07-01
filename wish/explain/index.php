<head>
	<link rel="stylesheet" href="../../stories/gigachad/assets/main.css">
	<style>
		*{
			font-family: sans-serif!important;
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
		<div id="prestory">
			<div style="position:absolute; left:0; top:0; width:100%; height:100%; transform: translate(0, 38%);">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846747/envi/assets/particle.jpg" style="width:150px; border-radius:50%;">
				<img src="//res.cloudinary.com/tfboson/image/upload/v1623846621/envi/assets/wave.gif" id="wave">
			</div>
			<div id="story"><span id="begin" style="cursor: pointer; margin-right:10px; text-decoration: underline"  onclick="next()">[Very boring ramble (1:30)]</span><span><a href="../../?rolled" style="color:white!important">[Get me outa here]</a></span></div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	var type_finished = true;
	var play_finished = true;
	var timeout = 550;
	function say(what){
		type_finished = false;
		play_finished = false;
		types(what, 0);
		play_sound(what, "Justin");
	}
	stage = 0;
	dialog = [];
	function next(){
		if(type_finished && play_finished){
			if(stage < dialog.length){
				console.log(stage);
				say(dialog[stage]);
			}
			if(stage == 2){
				$("#prestory img").css("animation", "spin 10s linear infinite");
				$("#wave").css("display", "block"); 
			}
			if(stage == 3){
				$("#wave").css("display", "none");
			}
			if(stage > dialog.length-1){
				$("#prestory img").css("animation", "pause");
				$("#story").html('<span><a href="../../?rolled" style="color:white!important;margin-right:10px;">[Very Pog peepoShy]</a></span><span><a href="../../?rolled" style="color:white!important">[Get me outa here]</a></span>');
			}else{
				stage++;
			}
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
			setTimeout(() => {
				type_finished = true;
				next();
			}, timeout);
		}
	}
	function play_sound(text, whom = "Brian"){
		if(text == ""){
			setTimeout(() => {
				play_finished = true;
				next();
			}, timeout);
		}else{
			var audio = new Audio("https://api.streamelements.com/kappa/v2/speech?voice="+whom+"&text="+encodeURIComponent(text.trim()));
			audio.play();
			audio.addEventListener('ended',function(){
				setTimeout(() => {
					play_finished = true;
					next();
				}, timeout);
			});
		}
	}
	
	dialog.push("Oh my god, this will be embarrassing! enviShy");
	dialog.push("");
	dialog.push("Ello cuties! AYAYA HYPERCLAP!");
	dialog.push("It's me again!");
	dialog.push("I want to make some things clear..");
	dialog.push("First of all, big shout out to @napmangastudio for the drawings used in this project!");
	dialog.push("The more talented person than I am..");
	dialog.push("Just wanted to dispel the delusion that I drew it");
	dialog.push("");
	dialog.push("Second, big congrats on your rolls Envi!");
	dialog.push("I see yesterday's inside joke, that you pull once, get everyone C6 didn't work here");
	dialog.push("You even said 'wakey wakey', on that dono which made me excited");
	dialog.push("But something went wrong..");
	dialog.push("You probably thought it was stuck on the OC pull..");
	dialog.push("But I never make broken things! Kapp");
	dialog.push("My bad, will make it clearer next time");
	dialog.push("Also you thought it was a wishing sim. Yeah, it's not.");
	dialog.push("Although I can make a game with this concept. Hmm WineTime");
	dialog.push("");
	dialog.push("And the last thing");
	dialog.push("Thank you guys for your support!");
	dialog.push("Working on this site is my hobby");
	dialog.push("I have a few personal projects I never finished");
	dialog.push("And probably never will");
	dialog.push("But this one is making me work hard just because of you Mr. Slipper and Chat!");
	dialog.push("I improve everyday with every change I make!");
	dialog.push("This is my contribution to this wholesome community!");
	dialog.push("enviLove to everyone!");
	dialog.push("");
	</script>
</body>