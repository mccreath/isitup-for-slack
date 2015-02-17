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


// Grab values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$text = $_POST['text'];
$token = $_POST['token'];
$team_id = $_POST['team_id'];
$channel_id = $_POST['channel_id'];
$channel_name = $_POST['channel_name'];
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];

$user_agent = "IsitupForSlack/1.0 (https://github.com/mccreath/istiupforslack; mccreath@gmail.org)";

$url_to_check = "http://isitup.org/".$text.".json";

$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_URL => $url_to_check,
  CURLOPT_USERAGENT => $user_agent
));
$ch_resp = curl_exec($ch);
curl_close($ch);

$resp_arr = json_decode($ch_resp,true);

if($ch_resp === FALSE){
  $reply = $url_to_check." could not be reached.";
} else {
  if($resp_arr["status_code"] == 1){
    $reply = ":thumbsup: I am happy to report that *".$resp_arr["domain"]."* is *up*!";
  } else if($resp_arr["status_code"] == 2){
    $reply = ":disappointed: I am sorry to report that *".$resp_arr["domain"]."* is *not up*!";
  } else if($resp_arr["status_code"] == 3){
    $reply = ":interrobang: *".$text."* does not appear to be a valid domain. "
    $reply .= "Please enter both the domain name AND suffix (ex: amazon.com or whitehouse.gov).";
  }
}

echo $reply;
