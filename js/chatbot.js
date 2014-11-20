// chatbot.js
// contains functions for use with chatbot web application

// Sends user input to controller for processing
// PRE: user_input and bot_response are defined and are strings
// POST: The div with class of chat-container has been appended with the response of the bot,
// the hidden input with id of bot_output has its value equal to the bot's response
function sendUserInput(user_input, bot_response) {
	$.ajax({
		url: 'controller.php?m=senduserinput',
		method: 'POST',
		data: {'user_input': user_input, 'bot_response': bot_response},
		success: function(data) {
			$('.chat-container').append('<p class="chat-name">Bot: ' + data + "</p>");
			$('.chat-container').animate({scrollTop: $('.chat-container').prop("scrollHeight")}, 500);
			$('#bot_output').val(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		}
	});
}

// Runs on page load
$(function() {
	// Click listener for form with id of chat-form
	$("#chat-form").on('submit', function(e) {
		e.preventDefault(); // stop the default action of form submit

		// get values of user input and bot output
		var user_input = $("#user_input").val();
		var bot_output = $("#bot_output").val();

		// add user's input to chat-container
		$('.chat-container').append('<p class="chat-name">Me: ' + user_input + '</p>');

		// reset the value of user's input
		$('#user_input').val('');

		// send the user's input to the bot
		sendUserInput(user_input, bot_output);
	});
});