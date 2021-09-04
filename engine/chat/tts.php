<?php
echo file_get_contents("https://api.streamelements.com/kappa/v2/speech?voice=Emma&text=".urlencode($_GET['text']));