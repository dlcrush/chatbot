<?php

	$bot = array();

	$bot['i milked your cow for you'] = "we don't have a cow we have a bull";

	var_dump(json_encode($bot));

	$myfile = fopen("json/bot.json", "w");
	fwrite($myfile, json_encode($bot));
	fclose($myfile);
	
	
?>