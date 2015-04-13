<?php

/*

REQUIREMENTS

* A custom slash commant on a Slack team
* A web server running PHP5 with cURL enabled

USAGE

* Place this script on a server running PHP5 with cURL.
* Set up a new custom slash command on your Slack team: 
  http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for 
  the command. /isitup is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the 
  autocomplete list for slash commands.
* If you do, enter a short description and usage hing.

*/


# Grab some of the values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$text = $_POST['text'];
$token = $_POST['token'];

# isitup.org doesn't require you to use API keys, but they do require that any automated script send in a user agent string.
# You can keep this one, or update it to something that makes more sense for you
$user_agent = "IsitupForSlack/1.0 (https://github.com/mccreath/istiupforslack; mccreath@gmail.org)";

# We're just taking the text exactly as it's typed by the user. If it's not a valid domain, isitup.org will respond with a `3`.
# We want to get the JSON version back (you can also get plain text).
$url_to_check = "http://isitup.org/".$text.".json";

# Set up cURL 
$ch = curl_init($url_to_check);

# Set up options for cURL 
# We want to get the value back from our query 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# Send in our user agent string 
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

# Make the call and get the response 
$ch_resp = curl_exec($ch);
# Close the connection 
curl_close($ch);

# Decode the JSON array sent back by isitup.org
$resp_arr = json_decode($ch_resp,true);

# Build our response 
# Note that we're using the text equivalent for an emoji at the start of each of the responses.
# You can use any emoji that is available to your Slack team, including the custom ones.
if($ch_resp === FALSE){
  # isitup.org could not reach the domain entered by the user 
  $reply = $url_to_check." could not be reached.";
} else {
  if($resp_arr["status_code"] == 1){
  	# Yay, the domain is up! 
    $reply = ":thumbsup: I am happy to report that *".$resp_arr["domain"]."* is *up*!";
  } else if($resp_arr["status_code"] == 2){
    # Boo, the domain is down. 
    $reply = ":disappointed: I am sorry to report that *".$resp_arr["domain"]."* is *not up*!";
  } else if($resp_arr["status_code"] == 3){
    # Uh oh, isitup.org doesn't think the domain entered by the user is valid
    $reply = ":interrobang: *".$text."* does not appear to be a valid domain. ";
    $reply .= "Please enter both the domain name AND suffix (ex: amazon.com or whitehouse.gov).";
  }
}

# Send the reply back to the user. 
echo $reply;
