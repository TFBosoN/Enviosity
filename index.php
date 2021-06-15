<?php
//background images from twitch thumbnails (populated daily)
$bg_images = json_decode(file_get_contents("./envi.json"));
//Bg settings
$imgh = 360;
$zoom = 2;

$without = "3 days without cursing";
$phrase_fs = false;

//COPIUM 
$alarm = false;
function alarm_html(){
	return '<div class="wrapper"><div class="alarm"><div class="light"><span></span><span></span><span></span><span></span><span></span></div><div class="bulb"><div class="eyes"><span></span><span></span></div><div class="mouth"></div></div><div class="base"></div></div></div>';
}

/*/
	RNG names
	Splitting into categories and choosing random for more variety
/*/

$names = explode("#", file_get_contents("./envi_names.txt"));
//Delete comments
foreach($names as $key => $name){
	$name = explode("\n", $name);
	unset($name[0]);
	$name = array_filter($name);
	$names[$key] = implode("\n", $name);
}
//fix later
$names = explode("\n", implode("\n",$names));
$names = array_filter($names);
$count = rand(0, count($names)-1);
$names = $names[$count];

$promote_name = array();
$categories = array_filter(explode("#", file_get_contents("./envi_names.txt")));
$rcat = rand(1, count($categories)-1); //Choosing rand category
$names = array_filter(explode("\n", $categories[$rcat]));
$count = rand(2,count($names)-1);


if(isset($_COOKIE['no_promo'])){
	$promote_name[] = $names[$count];
}else{
	$promote_name[] = "GIGACHAD";
	setcookie( "no_promo", true, time()+10 );
}



$names = $promote_name[rand(0,count($promote_name)-1)];


//RNG phrases on load screen
$phrase = array("NO MORE<br>F2P DAMAGE!", "\"BEST STREAMER IN THE WORLD!\"<br>--Barack Obama",'<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png" width="160" alt="enviLove" title="enviLove">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/slime.png" width="185" alt="slime" title="slime">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviAyaya.png" width="185" alt="enviAyaya" title="enviAyaya">');
//$phrase = array("0 days without<br><img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/WeirdChamp.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> and <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/monkaTOS.png' width='185' height='170' alt='WeirdChamp' title='WeirdChamp'> in the chat");
$phrase = $phrase[rand(0, count($phrase)-1)];

/*/
Slime RNG functions
Classes: 
spin  - spin clockwise
spins - spin counter clockwise
/*/
function get_spin(){
	//Spins or spin
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

$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/F2P.png";
switch($names){
	case "Dendriosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Dendriosity.jpg";
		$without = "0 days without being Envi";
	break;
	case "Mr. F2P":
		$without = "F2P <s>damage</s> <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/KEKWait.png' width='32' alt='KEKWait' title='KEKWait' style='vertical-align:middle'>";
	break;
	case "Mr. Screamer":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Screamer.png";
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Screamer.png" style="width:100%; height:100%;">';
		$without = "0 days without SCREAMING";
		$phrase_fs = true;
	break;
	case "Donowalliosity":
		$names .= " <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviWall.png' width='32' alt='enviWall' title='enviWall'>";
	break;
	case "Coderviosity":
		$names = "<a href='./coderviosity.html' style='text-decoration:underline; cursor: pointer'>".$names."</a>";
	break;
	case "Pepegiosity":
		$names .= " <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Pepega.png' width='32' alt='Pepega' title='Pepega'><img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Clap.gif' width='32' alt='Clap' title='Clap'>";
	break;
	case "Mr. Minimalist":
	case "Minimaliosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/minimalist.png";
		$without = "0 days without minimalism";
	break;
	case "Daddyosity":
	case "Daddy Envi":
	case "Mr. Polestripper":
		$names .= " <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviGasm.png' width='32' alt='enviGasm' title='enviGasm'>";
	break;
	case "Dylan":
	case "Dylan the villain":
	case "Dylanosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/dylan.png";
	break;
	case "Mr. Fishy":
	case "Fishywishes":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/fishy.jpg";
		$phrase = "<img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviAyaya.png' width='160' alt='enviAyaya' title='enviAyaya'><img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Clap.gif' width='140' alt='Clap' title='Clap'>";
	break;
	case "Eulanosity":
	case "Eulaviosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/eulaviosity.png";
	break;
	case "Copiosity":
		$avatar = rand(0,1)? "//i.imgur.com/wtaJ1zB.png" : "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviCOPIUM.jpg";
		$alarm = true;
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/COPIUM.png" width="160" alt="COPIUM" title="COPIUM">';
		$alarm_icon = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/COPIUM.png" width="64" alt="COPIUM" title="COPIUM">';
		$alarm_icon_s = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/COPIUM.png" width="18" alt="COPIUM" title="COPIUM">';
		$alarm_img = '//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/COPIUM.png';
		$without = "0 days without COPIUM";
		$alarm_msg = "WARNING! COPIUM OVERDOSE!";
	break;
	case "Hackiosity":
		$avatar = $alarm_img = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif";
		$alarm = true;
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="160" alt="HACKERMANS" title="HACKERMANS">';
		//$alarm_icon = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="64" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_icon_s = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="18" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_img = '//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif';
		$without = "0 days without HACKERMANS";
		$alarm_msg = 'WARNING! SYSTEM OVERRIDE!<br><br><a id="hack_text">Hacking in progress..</a><div class="progress"><div class="bar"></div></div>';
	break;
	case "YEPiosity":
		$names .= " <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/YEP.png' width='32' alt='YEP' title='YEP'>";
	break;
	case "SHEESHiosity":
		$names .= " <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviSHEESH.png' width='32' alt='enviSHEESH' title='enviSHEESH'>";
	break;
	case "Cabbage Head":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviCabbage.png";
	break;
	case "GIGACHAD":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623790335/envi/assets/Gigachad.jpg";
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
	<link rel="stylesheet" href="./assets/fa/css/all.min.css">
	<link rel="stylesheet" href="./assets/main.css">
	<style>
		.logo div{
			background-image:url('<?=$avatar;?>');
		}
		canvas {
			/transform: rotate(-30deg) scale(<?=$zoom;?>);
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
				<?php			
				if($alarm){
					echo alarm_html();
				} ?>
				<div class="slime">
					<img src="<?=($alarm)? $alarm_img: '//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/slime.png';?>" style="width:150px">
				</div>
			</td>
			<td style="width:150px;">
				<div>
					<a style="display:none">ENVI DonoWall Clap</a>
				</div>
			</td>
			<td class="second">
				<?php			
				if($alarm){
					echo alarm_html();
				} ?>
				<div class="slime">
					<img src="<?=($alarm)? $alarm_img : '//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/slime.png';?>" style="width:150px">
				</div>
			</td>
		</tr>
	</table>
	<canvas id="canvas" width="100%" height="100%"></canvas>
	<div class="container">
		<div id="presentation"><h1 class="banner" style="<?=($phrase_fs)?"height:100%":"";?>"><?=$phrase;?></h1></div>
		<div class="main" id="main" style="display:none;">
			<a class="logo"><div></div></a>
			<div class="AYAYA_social">
				<h1><?=$names;?></h1>
				<a><?=$without;?>!</a><br><br>
				<?php
				if($names == "Hackiosity"){
				?>
				<a style="font-size:20px">PSST I HACKED YOU SOME CODE FOR GFUEL</a><br>
				<a style="font-size:20px">use "ENVIOSITY" for 30% off until the end of weekend!</a>
				<?php
				}else{
				?>
				<a>GFUEL last day to use code "ENVIOSITY" for 30% off!</a>
				<?php
				}
				?>
				<?=($alarm)?"<br><br><a class='red'>".$alarm_msg."</a>":"";?>
				<br><br>
				<div class="lines">
					<span><a class="youtube" href="https://youtube.com/Enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><b>Youtube</b></a></span>
					<span><a class="twitch" href="https://www.twitch.tv/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-twitch"></i>';?><br><b>Twitch</b></a></span>
					<span><a class="youtube" href="https://www.youtube.com/channel/UCc-msH2ut_AGNtkZhLxOLew" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><b>VODs</b></a></span>
				</div>
				<div class="lines">
					<span><a class="twittor" href="https://twitter.com/Enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-twitter"></i>';?><br><b>Twitter</b></a></span>
					<span><a class="tiktok" href="https://www.tiktok.com/@enviosityclips" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-tiktok"></i>';?><br><b>Tiktok</b></a></span>
					<span><a class="instogram" href="https://instagram.com/enviosity/" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-instagram"></i>';?><br><b>Instagram</b></a></span>
				</div>
				<div class="lines">
					<span><a class="discord" href="https://discord.gg/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-discord"></i>';?><br><b>Discord</b></a></span>
					<span><a class="reddit" href="https://www.reddit.com/r/Enviosity/" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-reddit"></i>';?><br><b>Reddit</b></a></span>
					<span><a class="instogram" href="https://merch.streamelements.com/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fas fa-tshirt"></i>';?><br><b>Merch</b></a></span>
				</div>
				<a style="font-size:20px">GENSHIN IMPACT</a><br>
				<a style="font-size:11px; color:#ccc">useful tools</a>
				<div class="lines">
					<span style="width: auto;"><a class="discord" href="https://paimon.moe" target="_blank"><img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/paimonmoe.ico" style="vertical-align: middle;"><b style="font-family: sans-serif;
position:relative; font-size:20px">Paimon<div style="position: absolute; top: -9px; font-size: 14px; right: 0; color: rgb(78, 124, 255);">.moe</div></b></a></span>
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
							<td style="text-align:center; padding:10px"><a href='https://github.com/TFBosoN/enviosity' style="text-decoration:underline">GitHub</a> | <a href="./changelog.txt">Changelog</a> | <a href="./envi_names.txt">This is how viewers call me</a></td>
						</tr>
						<tr>
							<td style="text-align:center">Images by <a href="https://twitter.com/fishywishies" style="text-decoration:underline">@fishywishes!</a> <img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/fishy.jpg" height="18" width="18" alt="fishy" title="fishy"> | Site by <a href="https://tfb.su" style="text-decoration:underline">@TFBosoN</a> w/ <?=($alarm)? $alarm_icon_s : '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png" height="18" width="18" alt="enviLove" title="enviLove">';?></td>
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
	//HACKERMANS TEXT
	text = [ "UPLOADING VIRUSES..", "INSTALLING BACKDOOR..", "LOGGING PASSWORDS..", "OVERRIDING SECURITY PROTOCOL..", "PENETRATING THE SYSTEM..", "HACKING THE IP-ADDRESS..", "DOWNLOADING SECRET PORN STASH..", "MINING DOGE-COINS..", "GETTING SATELLITE DATA..", "INSERTING KEYLOGGER.."];
	var imgwidth = <?=$imgh/9*16;?>;
	var imgheight = <?=$imgh;?>;
	var num = 0;
	<?php
	if($names == "Hackiosity"){
	?>
	function randomString(num){
		console.log(num);
		//not random KEKW
		return text[num/*Math.floor(Math.random() * text.length)*/];
	}
	setInterval(function(){
		document.getElementById("hack_text").innerHTML = randomString(num);
		if(num>=text.length-1){
			num = 0;
		}else{
			num++;
		}
	},2707);
	<?php
	}
	?>
	</script>
	<script src='./assets/main.js'></script>
</body>
</html>
