<?php
include_once("config.php");
global $mysqli;

$mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['db']);
if($mysqli->connect_errno){
    printf("Cant connect: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->set_charset('utf8');

//check user
$user['access'] = 0;
$user['avatar'] = 'guest.jpg';
$user['username'] = 'Guest';

class html{
	function head($title, $desc = 'title', $logo = 'https://res.cloudinary.com/tfboson/logo.jpg'){
		if($desc=='title'){$desc=$title;}
        
        $arr = array(
            '{title}' => $title,
            '{desc}' => $desc,
            '{logo}' => $logo
        );
        
        echo strtr(file_get_contents("head.php", FILE_USE_INCLUDE_PATH), $arr);
	}
    function nav($search = 0, $search_ph = ""){
        global $user;
        ob_start();
        require_once "nav.php";
        $result = ob_get_clean();
        
        return $result;
    }
    function script(){
        ob_start();
        require_once "bot.php";
        $result = ob_get_clean();
        
        return $result;
    }
}