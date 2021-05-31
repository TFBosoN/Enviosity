<?php
//background images from twitch thumbnails (populated daily)
$bg_images = json_decode(file_get_contents("./envi.json"));
//Bg settings
$imgh = 360;
$zoom = 2;

//COPIUM 
$alarm = false;
function alarm_html(){
	return '<div class="wrapper"><div class="alarm"><div class="light"><span></span><span></span><span></span><span></span><span></span></div><div class="bulb"><div class="eyes"><span></span><span></span></div><div class="mouth"></div></div><div class="base"></div></div></div>';
}

/*/
	RNG names
	Splitting into categories and choosing random for more variety
/*/
$promote_name = "Hackiosity";
$categories = explode("#", file_get_contents("./envi_names.txt"));
$rcat = rand(1, count($categories)-1); //Choosing rand category
$names = array_filter(explode("\n", $categories[$rcat]));
$count = rand(1,count($names)-1);
$names = (rand(0,1))? $names[$count] : $promote_name; //50:50

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

//Some special site looks depending on name
/*
if($names=="Coderviosity" && !isset($_GET["real_site_pls"])){
	die("<body><h1 style='color:red'>Hello!</h1><blockquote><br>&#171;I do know how to code&#187;</blockquote><figcaption>--Coderviosity, <cite>05/28/2021</cite><br><br><a href='?real_site_pls'>Real site please!</body>");
}
*/

$avatar = "//enviosity.com/assets/avatar.png";
switch($names){
	case "Coderviosity":
		$names = "<a href='//enviosity.com/coderviosity.html'>".$names."</a>";
	break;
	case "Pepegiosity":
		$names .= " <img src='//enviosity.com/assets/Pepega.png' width='32' alt='Pepega' title='Pepega'><img src='//enviosity.com/assets/Clap.gif' width='32' alt='Clap' title='Clap'>";
	break;
	case "Mr. Minimalist":
		$avatar = "//enviosity.com/assets/minimalist.png";
	break;
	case "Daddyosity":
	case "Daddy Envi":
	case "Boobiosity":
	case "Mr. Polestripper":
		$names .= " <img src='//enviosity.com/assets/enviGasm.png' width='32' alt='enviGasm' title='enviGasm'>";
	break;
	case "Dylan":
	case "Dylan the villain":
	case "Dylanosity":
		$avatar = "//enviosity.com/assets/dylan.png";
	break;
	case "Mr. Fishy":
	case "Fishywishes":
		$avatar = "//enviosity.com/assets/fishy.png";
		$phrase = "<img src='//enviosity.com/assets/AYAYA.png' width='160' alt='AYAYA' title='AYAYA'><img src='//enviosity.com/assets/Clap.gif' width='32' alt='Clap' title='Clap'>";
	break;
	case "Eulanosity":
		$avatar = "//enviosity.com/assets/eulaviosity.png";
	break;
	case "Copiosity":
		$avatar = "https://i.imgur.com/wtaJ1zB.png";
		$alarm = true;
		$phrase = '<img src="//enviosity.com/assets/COPIUM.png" width="160" alt="COPIUM" title="COPIUM">';
		$alarm_icon = '<img src="//enviosity.com/assets/COPIUM.png" width="64" alt="COPIUM" title="COPIUM">';
		$alarm_icon_s = '<img src="//enviosity.com/assets/COPIUM.png" width="18" alt="COPIUM" title="COPIUM">';
		$alarm_img = '//enviosity.com/assets/COPIUM.png';
		$alarm_name = "COPIUM";
		$alarm_msg = "WARNING! COPIUM OVERDOSE!";
	break;
	case "Hackiosity":
		$avatar = $alarm_img = "//enviosity.com/assets/HACKERMANS.gif";
		$alarm = true;
		$phrase = '<img src="//enviosity.com/assets/HACKERMANS.gif" width="160" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_icon = '<img src="//enviosity.com/assets/HACKERMANS.gif" width="64" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_icon_s = '<img src="//enviosity.com/assets/HACKERMANS.gif" width="18" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_img = '//enviosity.com/assets/HACKERMANS.gif';
		$alarm_name = "HACKERMANS";
		$alarm_msg = 'WARNING! SYSTEM OVERRIDE!<br><br><a id="hack_text">Hacking in progress..</a><div class="progress"><div class="bar"></div></div>';
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
	<link rel="stylesheet" href="//enviosity.com/assets/main.css">
	<style>
		.logo div{
			background-image:url('<?=$avatar;?>');
		}
		canvas {
			transform: rotate(-30deg) scale(<?=$zoom;?>);
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
		}
		.slimes .first img{
			padding-left: <?=rand(-150, 150);?>px;
			padding-top: <?=rand(-150, 150);?>px;
		}
		.slimes .second img{
			padding-left: <?=rand(-150, 150);?>px;
			padding-top: <?=rand(-150, 150);?>px;
		}
	</style>
</head>
<body onload="draw();">
	<div id="cover"></div>
	<table class="slimes" id="slimes" style="">
		<tr>
			<td class="first">
				<?			
				if($alarm){
					echo alarm_html();
				} ?>
				<div class="slime">
					<img src="<?=($alarm)? $alarm_img: '//enviosity.com/assets/slime.png';?>" style="width:150px">
				</div>
			</td>
			<td style="width:150px;">
				<div>
					<a style="display:none">ENVI DonoWall Clap</a>
				</div>
			</td>
			<td class="second">
				<?			
				if($alarm){
					echo alarm_html();
				} ?>
				<div class="slime">
					<img src="<?=($alarm)? $alarm_img : '//enviosity.com/assets/slime.png';?>" style="width:150px">
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
				<h1><?=$names;?></h1>
				<a>0 days without <?=($alarm)? $alarm_name : "streaming!";?></a><br>
				<a>GFUEL use code "ENVIOSITY" for 10% off!</a>
				<?=($alarm)?"<br><br><a class='red'>".$alarm_msg."</a>":"";?>
				<br><br>
				<div class="lines">
					<span><a class="youtube" href="https://youtube.com/Enviosity" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><b>Youtube</b></a></span>
					<span><a class="twitch" href="https://www.twitch.tv/enviosity" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-twitch"></i>';?><br><b>Twitch</b></a></span>
					<span><a class="youtube" href="https://www.youtube.com/channel/UCc-msH2ut_AGNtkZhLxOLew" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><b>VODs</b></a></span>
				</div>
				<div class="lines">
					<span><a class="twittor" href="https://twitter.com/Enviosity" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-twitter"></i>';?><br><b>Twitter</b></a></span>
					<span><a class="tiktok" href="https://www.tiktok.com/@enviosityclips" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-tiktok"></i>';?><br><b>Tiktok</b></a></span>
					<span><a class="instogram" href="https://instagram.com/enviosity/" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-instagram"></i>';?><br><b>Instagram</b></a></span>
				</div>
				<div class="lines">
					<span><a class="discord" href="https://discord.gg/enviosity" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fab fa-discord"></i>';?><br><b>Discord</b></a></span>
					<span><a class="instogram" href="https://merch.streamelements.com/enviosity" target="_blank"><?=($alarm)? $alarm_icon: '<i class="fas fa-tshirt"></i>';?><br><b>Merch</b></a></span>
				</div>
				<br>
				<br>
				<br>
				<br>
				<div class="credits">
					<table align="center">
						<tr>
							<td style="text-align:center"><div style="display:none" id="slime_warning"><a style="font-size:11px">slimes are resource intence!</a> <a style="font-size:10px; text-decoration:underline; cursor:pointer" onclick='enable_slimes()'>Enable them</a></div></td>
						</tr>
						<tr>
							<td style="text-align:center">Images by <a>@fishywishes!</a> | Site by <a>@TFBosoN</a> w/ <?=($alarm)? $alarm_icon_s : '<img src="//enviosity.com/assets/enviLove.png" height="18" width="18" alt="enviLove" title="enviLove">';?> | <a href='https://github.com/TFBosoN/enviosity' style="text-decoration:none">GITHUB</a></td>
						</tr>
					</table>
				</div>
				<div id="popup" onclick="stop();" style="display:none"></div>
			</div>
		</div>
	</div>
	<script>
	//Background
	/*/
		TODO rewrite this shit to ajax
	/*/
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
	var imgwidth = <?=$imgh/9*16;?>;
	var imgheight = <?=$imgh;?>;
	function randomString(){
		text = ["DOWNLOADING SECRET PORN STASH..", "UPLOADING VIRUSES..", "INSTALLING BACKDOOR..", "LOGGING PASSWORDS..", "OVERRIDING SECURITY PROTOCOL..", "PENETRATING THE SYSTEM..", "HACKING THE IP-ADDRESS..", "MINING DOGE-COINS..", "GETTING SATELLITE DATA..", "INSERTING KEYLOGGER.."];
		return text[Math.floor(Math.random() * text.length)];
	}
	setInterval(function(){
		document.getElementById("hack_text").innerHTML = randomString();
	},2680);	
	</script>
	<script src='//enviosity.com/assets/main.js'></script>
</body>
</html>
