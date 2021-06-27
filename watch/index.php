<?php
require_once "../engine/core.php";

$html = new html;
?>
<html lang="ru-RU">

<head>
    <?php
    $html->head('Enviosity', 'Watch live!');
    ?>
    <link rel="stylesheet" href="//enviosity.com/assets/css/main.min.css">
	<link rel="stylesheet" href="//enviosity.com/assets/css/cinema.min.css">
</head>

<body>
    <div class="ui">
        <?=$html->nav();?>
        <div class="layout">
            <div class="content container-fluid" style="text-align:center; padding: 0; margin:0">
				<div id="twitch-embed"></div>
				<!-- Load the Twitch embed JavaScript file -->
				<script src="https://embed.twitch.tv/embed/v1.js"></script>

				<!-- Create a Twitch.Embed object that will render within the "twitch-embed" element -->
				<script type="text/javascript">
				
				Width = window.innerWidth-18;
				Height = window.innerHeight-67;
				
				new Twitch.Embed("twitch-embed", {
					width: Width,
					height: Height,
					channel: "enviosity",
				});
				</script>
            </div>
        </div>
    </div>
	<?=$html->script();?>
</body>
</html>