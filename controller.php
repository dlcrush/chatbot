<?php

	define('FILE', 'json/bot.json');

	// processes user input and sends back bot response
	// PRE: user_input and bot_response are defined and are strings
	// POST: function returns a string that is the response from the bot to the input from the user
	function sendUserInput($user_input, $bot_response) {
		$user_input = strip_tags($user_input);

		$bot = getBot(FILE);

		// minify strings to only lowercase alphanumeric characters
		$minified_user_input = strtolower(str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $user_input)));
		$minified_bot_response = strtolower(str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $bot_response)));

		if (array_key_exists($minified_user_input, $bot)) {
			echo strip_tags($bot[$minified_user_input]);
		}
		else {
			$k = array_rand($bot);
			echo strip_tags($bot[$k]);
		}

		$bot[$minified_bot_response] = $user_input;

		saveBot(FILE, $bot);
	}

	// Gets the bot associate array
	// PRE: file is defined and a path to a valid file
	// POST: an associativee array of the bot's data is returned
	function getBot($file='') {
		return json_decode(file_get_contents($file), true);
	}

	// Saves the associate array to a json file
	// PRE: file is defined and a path to a valid file, bot is defined
	// POST: an associative array containing the bot's data
	function saveBot($file='', $bot=array()) {
		file_put_contents($file, json_encode($bot));
	}

	if ($_GET['m'] == 'senduserinput' && isset($_POST['user_input']) && isset($_POST['bot_response'])) {
		sendUserInput($_POST['user_input'], $_POST['bot_response']);
	} else {
		// could not find request
		http_response_code(404);
	}
?>