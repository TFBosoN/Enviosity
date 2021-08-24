<html>
<head>
<title>BOOBA chat</title>
<style>
html,body {
	font-family: 'Roboto', sans-serif;
	background-color: hsla(0, 0%, 12%, 1);
	color: hsla(0, 0%, 100%, .95);
	font-size: 15px;
	line-height:1.8;
}
#chat {
	position: absolute;
	left: 0;
	padding: 2px;
	bottom:0; 
	width:396px; 
	height: 100%;
	z-index:99; 
	background-color: hsla(0, 0%, 12%, 1);
	overflow-y: scroll;
	overflow-x: hidden;
}
#chat::-webkit-scrollbar-button {
background-image:url('');
background-repeat:no-repeat;
width:5px;
height:0px
}

#chat::-webkit-scrollbar-track {
background-color:#ecedee
}

#chat::-webkit-scrollbar-thumb {
-webkit-border-radius: 0px;
border-radius: 0px;
background-color:#6dc0c8;
}

#chat::-webkit-scrollbar-thumb:hover{
background-color:#56999f;
}

#chat::-webkit-resizer{
background-image:url('');
background-repeat:no-repeat;
width:4px;
height:0px
}

#chat::-webkit-scrollbar{
width: 4px;
}
.chat-line {
	-webkit-transition: all 1s ease-in;
	-moz-transition: all 1s ease-in;
	-ms-transition: all 1s ease-in;
	-o-transition: all 1s ease-in;
	transition: all 1s ease-in;
}
.chat-line[data-faded] {
	opacity: 1;
}
.chat-line.chat-action {
}
.chat-line.chat-notice {
	opacity: .7;
	font-weight: 300;
}
.chat-line.chat-notice[data-level] {
}
.chat-line.chat-notice[data-level="-4"] {
	color: hsla(250, 80%, 65%, 1);
	font-style: italic;
}
.chat-line.chat-notice[data-level="-3"] {
	color: hsla(200, 80%, 50%, 1);
	font-style: italic;
}
.chat-line.chat-notice[data-level="-2"] {
	color: hsla(160, 80%, 50%, 1);
	font-style: italic;
}
.chat-line.chat-notice[data-level="-1"] {
	color: hsla(100, 80%, 50%, 1);
	font-style: italic;
}
.chat-line.chat-notice[data-level="1"] {
	color: hsla(55, 100%, 50%, 1);
}
.chat-line.chat-notice[data-level="2"] {
	color: hsla(30, 100%, 50%, 1);
	font-weight: 400;
}
.chat-line.chat-notice[data-level="3"] {
	color: hsla(0, 100%, 50%, 1);
	font-weight: 400;
}
.chat-line.chat-notice[data-level="4"] {
	color: hsla(0, 100%, 50%, 1);
	font-weight: 700;
}
.chat-line.chat-notice[data-faded] {
	opacity: .3;
}
.chat-line.chat-timedout {
	opacity: .2;
	font-size: .75em;
	-webkit-transition: all 100ms ease-in;
	-moz-transition: all 100ms ease-in;
	-ms-transition: all 100ms ease-in;
	-o-transition: all 100ms ease-in;
	transition: all 100ms ease-in;
}
.chat-line.chat-cleared {
	opacity: .2;
	font-size: .33em;
	-webkit-transition: all 100ms ease-in;
	-moz-transition: all 100ms ease-in;
	-ms-transition: all 100ms ease-in;
	-o-transition: all 100ms ease-in;
	transition: all 100ms ease-in;
}
.chat-channel {
	margin-right: .375em;
	opacity: .6;
	font-weight: 300;
}
.chat-name {
	font-weight: 700;
}
.chat-colon {
	margin-right: .375em;
	opacity: .85;
}
.chat-line:not(.chat-action) .chat-colon:after {
	content: ':';
}
.chat-message {
	font-weight: 400;
}
.chat-line:not(.chat-action) .chat-message {
	color: inherit !important;
}

.emoticon {
	background-position: center center;
	background-repeat: no-repeat;
	margin: -5px 0;
	display: inline-block;
	vertical-align: middle !important;
	height: 1.5em;
	font-size: 18px;
}

.chat-badges {
	margin-right: .125em;
}
.chat-badges > div {
	margin-bottom: 1px;
	border-radius: 2px;
	height: 1em;
	min-width: 1em;
	display: inline-block;
	vertical-align: middle;
	background-size: contain;
	background-repeat: no-repeat;
	margin-right: .3em;
}

.chat-badge-mod {
	background-color: hsl(105, 89%, 36%);
	background-image: url(http://www.twitch.tv/images/xarth/badge_mod.svg);
}
.chat-badge-turbo {
	background-color: hsl(261, 43%, 45%);
	background-image: url(http://www.twitch.tv/images/xarth/badge_turbo.svg);
}
.chat-badge-broadcaster {
	background-color: hsl(0, 81%, 50%);
	background-image: url(http://www.twitch.tv/images/xarth/badge_broadcaster.svg);
}
.chat-badge-admin {
	background-color: hsl(40, 96%, 54%);
	background-image: url(http://www.twitch.tv/images/xarth/badge_admin.svg);
}
.chat-badge-staff {
	background-color: hsl(268, 55%, 13%);
	background-image: url(http://www.twitch.tv/images/xarth/badge_staff.svg);
}
.chat-badge-subscriber {
}
.chat-badge-bot {
	background-image: url(https://cdn.betterttv.net/tags/bot.png);
}


[class*="chat-delete"] {
}
.chat-delete-timeout {
}
.chat-delete-clear {
}

[class*="chat-hosting"] {
}
.chat-hosting-yes {
}
.chat-hosting-no {
}

[class*="chat-connection"] {
}
[class*="chat-connection-good"] {
}
[class*="chat-connection-bad"] {
}
.chat-connection-good-connecting {
}
.chat-connection-good-logon {
}
.chat-connection-good-connected {
}
.chat-connection-good-reconnect {
}
.chat-connection-bad-fail {
}
.chat-connection-bad-disconnected {
}

[class*="chat-room"] {
	font-size: .5em;
}
.chat-room-join {
}
.chat-room-part {
}

.chat-crash {
}
#twitch{
	position:absolute;
	top:0;
	left:400px;
	height:100%;
}
</style>
</head>
<body>
	<div id="chat"></div>
</iframe>

<script src="tmi.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="jquery.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="chat.js"></script>
</body>
</html>