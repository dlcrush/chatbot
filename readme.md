### Chatbot ###

A simple, crappy chatbot. 

#### How it works ####

When the user enters a phrase, the bot will respond with the response it has stored for the user's input. If there is no existing entry for the user's input, a random response from the bot's knowledge base is returned. The bot's knowledge base is updated after every user response. For example, if the bot's previous response was "Hello" and the user entered "Hi" then the bot's knowledge base would map the input "Hello" to "Hi".

The bot's knowledge base is maintained in a json file. The property name is the key, the response is the value.