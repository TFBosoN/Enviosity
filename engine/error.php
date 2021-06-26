<?php
$err="404 Not Found";
if(isset($_GET['error'])){
	$err = $_GET['error'];
}
$err="Error ".$err;
$list = array(
	array("Wake up","Neo ...","The Matrix has you",$err), 
	array("Password: %$*=#!.","Access Denied",$err), 
	array(">.>","<.<","=.=",$err), 
	array("Hey you!","Yes, YOU!","Listen closely..",$err), 
	array("ELLO!!","AAAYYY!","IS SOMEONE HERE?",$err),
	array("Oh no","Oh no no no","IT'S COMING!! RUN!",$err),
	array("Another day..","Another.. ",$err),
	array("If you stare into the abyss.. ","The abyss stares back at you.. ","Oh look what's that..",$err),
	array("Bad wolf",$err)
);
$key = array_rand($list);
$num = count($list[$key]);
$list = '"'.implode('","', $list[$key]).'"';
?>
<html>
<head>
<meta charset="UTF-8">
<title>Enviosity! | <?=$err;?></title>
<style>
@import url('https://fonts.googleapis.com/css?family=Press+Start+2P');
html,
body {
font-family: 'Press Start 2P', monospace;
background: #171717;
height: 100%;
margin:0;
user-select: none
}
.container {
height: 100%;
width: 100%;
justify-content: center;
align-items: center;
display: flex;
}
.text {
font-weight: 100;
font-size: 28px;
color: #00b300;
}
.dud {
color: #00b300;
}
</style>
</head>
<body>
<div class="container">
<div class="text"></div>
</div>
<script>
"use strict";function _classCallCheck(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}var TextScramble=function(){function t(e){_classCallCheck(this,t),this.el=e,this.chars='!<>-_\\/[]{}—=+*^?#________%@$|,.№&"`~____',this.update=this.update.bind(this)}return t.prototype.setText=function(t){var e=this,r=this.el.innerText,a=Math.max(r.length,t.length),n=new Promise(function(t){return e.resolve=t});this.queue=[];for(var s=0;a>s;s++){var h=r[s]||"",o=t[s]||"",i=Math.floor(30*Math.random()),u=i+Math.floor(65*Math.random());this.queue.push({from:h,to:o,start:i,end:u})}return cancelAnimationFrame(this.frameRequest),this.frame=0,this.update(),n},t.prototype.update=function(){for(var t="",e=0,r=0,a=this.queue.length;a>r;r++){var n=this.queue[r],s=n.from,h=n.to,o=n.start,i=n.end,u=n.char;this.frame>=i?(e++,t+=h):this.frame>=o?((!u||Math.random()<.28)&&(u=this.randomChar(),this.queue[r].char=u),t+='<span class="dud">'+u+"</span>"):t+=s}this.el.innerHTML=t,e===this.queue.length?this.resolve():(this.frameRequest=requestAnimationFrame(this.update),this.frame++)},t.prototype.randomChar=function(){return this.chars[Math.floor(Math.random()*this.chars.length)]},t}(),phrases=[<?=$list;?>],el=document.querySelector(".text"),fx=new TextScramble(el),counter=0,next=function t(){var e=1500;<?=$num-1;?>==counter&&(e=3000),fx.setText(phrases[counter]).then(function(){setTimeout(t,e)}),counter = (counter + 1) % phrases.length};next();
</script>
</body>
</html>
