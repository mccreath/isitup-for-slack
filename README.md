# isitup-for-slack
Custom slash command to use isitup.org to check if a site is up from within Slack

## REQUIREMENTS

* A custom slash command on a Slack team
* A web server running PHP5 with cURL enabled

## USAGE

* Place the `isitup.php` script on a server running PHP5 with cURL.
* Set up a new custom slash command on your Slack team: http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for the command. /isitup is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the autocomplete list for slash commands.
* If you do, enter a short description and usage hint.

# TUTORIAL

Is It Up? is a great, simple service for checking the status of a website. All you have to do is call the site with a URL that contains the domain you want to check and the format you want the data returned in, either comma-separated text or JSON. This makes it ideal for using with cURL, which allows you to programmatically call URLs and get data back from them.

Slack's custom slash commands perform a very simple task: they take whatever text you enter after the command itself (along with some other predefined values), send it to a URL, then accept whatever the script returns and posts it as a Slackbot message to the person who issued the command. What you do with that text at the URL is what makes slash commands so useful. 

For example, you have a script that translates English to French, so you create a slash command called `/translate`, and expect that the user will enter an English word that they'd like translated into French. When the user types `/translate dog` into the Slack message field, Slack bundles up the text string `dog` with those other server variables and sends the whole thing to your script, which performs its task of finding the correct French word, `chien`, and sends it back to Slack along with whatever message you added with your script has, and Slack posts it back to the user as `The French word for "dog" is "chien"`. No one else on the team will see message, since it's from Slackbot to the user. 

You can read more about slash commands here: https://api.slack.com/slash-commands

## What we'll be using

* PHP (http://php.net)
* JSON (JavaScript Object Notation - http://json.org/)
* cURL (http://curl.haxxe.se)

## 

## Set up your slash command

Go to your Slack integrations page and add a new slash command: http://my.slack.com/services/new/slash-commands 

In the "Choose a command" field, enter the text that you want users to enter in Slack to trigger the command. In this case `isitup` is easy to remember, so let's go with that.


## 

