<?php
//background images from twitch thumbnails (populated daily)
if(isset($_GET['rolled']) || isset($_GET['no_wish'])){
	setcookie("rolled", 1, time()+60*60*24*30, "/");
}

header("Access-Control-Allow-Origin: api.enviosity.com");
$bg_images = json_decode(file_get_contents("./envi.json"));
//Bg settings
$imgh = 160;
$zoom = 2;

$without = "0 days without streaming!";
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


if(isset($_COOKIE['no_promo']) || true){
	$promote_name[] = $names[$count];
}else{
	$promote_name[] = "Dogiosity";
	setcookie( "no_promo", true, time()+10 );
}



$names = $promote_name[rand(0,count($promote_name)-1)];


//RNG phrases on load screen
$phrase = array("NO MORE<br>F2P DAMAGE!", "\"BEST STREAMER IN THE WORLD!\"<br>--Barack Obama",'<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png" width="160" alt="enviLove" title="enviLove">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/slime.png" width="185" alt="slime" title="slime">', '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviAyaya.png" width="185" alt="enviAyaya" title="enviAyaya">', "I'm old enough to be<br>your dad!", "Welcome to the weeb nation!", "Welcome to sandbaggers sanctuary!");
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

if(isset($_COOKIE['rolled'])){
	$avatar = "https://res.cloudinary.com/tfboson/image/upload/v1625076133/envi/assets/9herpoa3c6671.webp";
}

switch($names){
	case "Dogiosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1625171913/envi/assets/Doggiosity.png.jpg";
		$without = "0 days without woof";
	break;
	case "Dendriosity":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Dendriosity.jpg";
		$without = "0 days without you <3";
	break;
	case "Mr. F2P":
		$without = "F2P <s>damage</s> <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/KEKWait.png' width='32' alt='KEKWait' title='KEKWait' style='vertical-align:middle'>";
	break;
	/*case "Mr. Screamer":
		$avatar = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Screamer.png";
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/Screamer.png" style="width:100%; height:100%;">';
		$without = "0 days without SCREAMING";
		$phrase_fs = true;
	break;*/
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
	case "Mr. Booty Slapper":
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
	case "A blue haired idiot":
		$without = "Probably";
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
	/*case "Hackiosity":
	case "Hackerosity":
		$avatar = $alarm_img = "//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif";
		$alarm = true;
		$phrase = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="160" alt="HACKERMANS" title="HACKERMANS">';
		//$alarm_icon = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="64" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_icon_s = '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif" width="18" alt="HACKERMANS" title="HACKERMANS">';
		$alarm_img = '//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/HACKERMANS.gif';
		$without = "0 days without HACKERMANS";
		$alarm_msg = 'WARNING! SYSTEM OVERRIDE!<br><br><a id="hack_text">Hacking in progress..</a><div class="progress"><div class="bar"></div></div>';
	break;*/
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
$without = "WE LOVE YOU ENVI  <img src='//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png' width='32' alt='enviLove' title='enviLove'>";
?>

<html>
<head>
	<title>Enviosity LIVE NOW! 🔴</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta charset="utf-8">
	<meta name="description" CONTENT="Enviosity's f2p website">
	<meta name="keywords" content="enviosity, f2p, gamer, streamer, youtube, social, genshin, impact, genshin impact, slipper">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Staatliches&display=swap" rel="stylesheet"> 
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
		span .badge{
			font-size: 12px;
			position: absolute;
			right: -5px;
			top: -5px;
			width: 20px;
			margin:0;
			font-family:initial;
		}
		#first_logo{
			transition: opacity 2s ease-in-out;
			opacity:1;
		}
		#sec_logo{
			position:absolute;
			z-index:-9;
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
	<div style="position: fixed; left: 0; top:0; width:100%; height: 100%; opacity:0.5">WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI! YOU ARE THE BEST ENVI! WE CARE ABOUT YOU ENVI! WE ARE HERE FOR YOU! WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!WE LOVE YOU ENVI! WE NEED YOU ENVI! ENVI IS THE BEST STREAMER! YOU ARE OUR KING! LOVE TO MR ENVI! GROUP HUG FOR ENVI! ENVI IS THE BEST! WE LOVE AND CARE ABOUT YOU ENVI!</div>
	<div class="container">
		<!-- window.open('//enviosity.com/chat/', 'popup', 'location=0,width=400,height=800,left=500,top=55'); return false; -->
		<div id="presentation"><h1 class="banner" style="<?=($phrase_fs)?"height:100%":"";?>"><?=$phrase;?></h1></div>
		<div class="main" id="main" style="display:none;">
			<a class="logo"><div id="first_logo"></div><div id="sec_logo"></div></a>
			<div class="AYAYA_social">
				<h1><?=$names;?></h1>
				<a><?=$without;?></a><br><br>
				<a>GFUEL use code "ENVIOSITY" for 10% off!</a><br>
				<?=($alarm)?"<br><br><a class='red'>".$alarm_msg."</a>":"";?>
				<br>
				<a href="" style="color:white; font-size: 26px;">Watch Enviosity LIVE NOW! 🔴</a><br>
				<div class="lines">
					<span><a class="youtube" href="https://youtube.com/Enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><l>Youtube</l></a></span>
					<span><a class="twitch" href="https://www.twitch.tv/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-twitch"></i>';?><br><l>Twitch</l></a></span>
					<span><a class="youtube" href="https://www.youtube.com/channel/UCc-msH2ut_AGNtkZhLxOLew" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-youtube"></i>';?><br><l>VODs</l></a></span>
				</div>
				<div class="lines">
					<span><a class="twittor" href="https://twitter.com/Enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-twitter"></i>';?><br><l>Twitter</l></a></span>
					<span><a class="instogram" href="https://instagram.com/enviosity/" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-instagram"></i>';?><br><l>Instagram</l></a></span>
					<span><a class="tiktok" href="https://www.tiktok.com/@enviosityclips" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-tiktok"></i>';?><br><l>Tiktok</l></a></span>
				</div>
				<div class="lines">
					<span><a class="discord" href="https://discord.gg/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-discord"></i>';?><br><l>Discord</l></a></span>
					<span><a class="instogram" href="https://merch.streamelements.com/enviosity" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fas fa-tshirt"></i>';?><br><l>Merch</l></a></span>
					<span><a class="reddit" href="https://www.reddit.com/r/Enviosity/" target="_blank"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fab fa-reddit"></i>';?><br><l>Reddit</l></a></span>
				</div><br>
				<a style="font-size:26px">= GENSHIN IMPACT =</a><br>
				<div class="lines">
					<span style="width: auto;"><a class="discord" href="https://paimon.moe" target="_blank"><img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/paimonmoe.ico" style="vertical-align: middle;"><b style="font-family: sans-serif; position:relative; font-size:20px">Paimon<div style="position: absolute; top: -9px; font-size: 14px; right: 0; color: rgb(78, 124, 255);">.moe</div></b></a></span>
					<span style="width: auto;"><a class="discord" href="https://webstatic-sea.mihoyo.com/ys/event/signin-sea/index.html?act_id=e202102251931481" target="_blank"><img src="//res.cloudinary.com/tfboson/image/upload/v1623974211/envi/assets/Paimon.png" style="vertical-align: middle; height:72px"><l style="position:relative; font-size:20px">Login<div style="position: absolute; top: -22px; left: 0;">Daily</div></l></a></span>
					<span style="width: auto;"><a class="discord" href="https://webstatic-sea.mihoyo.com/app/ys-map-sea/" target="_blank"><img src="data:image/png;base64,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" style="vertical-align: middle; height:72px"><l style="position:relative; font-size:20px">HoYoLAB<div style="position: absolute; top: -22px; left: 0;white-space: nowrap;">World Map</div></l></a></span>
				</div>
				<a style="font-size:26px">= MISC =</a><br>
				<div class="lines">
					<span style="position:relative"><a class="alist" href="https://myanimelist.net/animelist/Enviosity"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fas fa-list-alt"></i>';?><br><l style="position: absolute; left: 50%; transform: translate(-50%);">MyAnimeList</l></a></span>
					<span style="position:relative"><a class="book" href="./stories/"><?=($alarm && !empty($alarm_icon))? $alarm_icon: '<i class="fad fa-books"></i>';?><br><l style="position: absolute; left: 50%; transform: translate(-50%);">Stories</l></a><!--<span class="badge badge-pill badge-danger">1</span>--></span>
				</div>
				<br>
				<br>
				<br>
				<br>
				<div class="credits">
					<table align="center">
						<tr>
							<td style="text-align:center"><div style="display:none" id="slime_warning"><a style="font-size:14px">slimes are resource intence!</a> <a style="font-size:14px; cursor:pointer" onclick='enable_slimes()'>Enable them</a></div></td>
						</tr>
							<td class="bot_links" style="text-align:center; padding:10px"><a href='https://github.com/TFBosoN/enviosity'>GitHub</a> | <a href="./changelog.txt">Changelog</a> | <a href="./envi_names.txt">This is how viewers call me</a></td>
						</tr>
						<tr>
							<td style="text-align:center">Emotes by <a href="https://twitter.com/fishywishies">@fishywishes!</a> <img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/fishy.jpg" height="18" width="18" alt="fishy" title="fishy"> | Site by <a href="https://tfb.su">@TFBosoN</a> w/ <?=($alarm)? $alarm_icon_s : '<img src="//res.cloudinary.com/tfboson/image/upload/v1623506141/envi/assets/enviLove.png" height="18" width="18" alt="enviLove" title="enviLove">';?></td>
						</tr>
					</table>
				</div>
				<div id="popup" onclick="stop();" style="display:none"></div>
			</div>
		</div>
	</div>
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
				$dat->thumbnail_url = str_replace("%{width}", 284, $dat->thumbnail_url);
				$dat->thumbnail_url = str_replace("%{height}", 160, $dat->thumbnail_url);
				echo '"'.explode("cf_vods/", $dat->thumbnail_url)[1].'",';
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
	/*
	$.ajax({
		url: "https://api.enviosity.com/v1/reddit/getFanArt/",
		type: "GET",
		dataType: "json"
	}).done(function(rdata){
		console.log(rdata);
		show_image(rdata, 0);
	});
	function show_image(rdata, n){
		if(n>rdata.length-1){
			n = 0;
		}
		console.log(n);
		$('#sec_logo').css("background-image", "url('"+rdata[n]+"')");
		setTimeout(() => {
			$('#first_logo').css("opacity", "0");
			setTimeout(() => {
				$('#first_logo').css("background-image", "url('"+rdata[n]+"')");
				$('#first_logo').css("opacity", "1");
				setTimeout(() => { show_image(rdata, n+1); }, 3200);
			}, 2000);
		}, 1000);
	}*/
	</script>
	<script src='./assets/main.js'></script>
</body>
</html>
