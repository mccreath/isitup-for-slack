# isitup-for-slack

Custom slash command to use isitup.org to check if a site is up from within Slack

## REQUIREMENTS

* A custom slash command on a Slack team
* A web server running PHP5 with cURL enabled
* A valid SSL certificate for your web server (not self-signed)

## USAGE

* Place the `isitup.php` script on a server running PHP5 with cURL and a valid SSL certificate.
* Set up a new custom slash command on your Slack team: http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for the command. /isitup is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the autocomplete list for slash commands.
* If you do, enter a short description and usage hint.
* Update the `isitup.php` script with your slash command's token.

## DOWNLOAD 

You can download the completed script and a tutorial for writing your own at https://github.com/mccreath/isitup-for-slack/
