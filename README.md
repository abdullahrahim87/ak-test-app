# ak-test-app
This is a test to build Slack Bot App

##Deployment Steps:

1. Change .env file. 

SLACK_CLIENT_ID=*** (Slack Client ID)<br>
SLACK_SECRET=*** (Secret key got from the channel creation).<br>
SLACK_REDIRECT_URI=http://abdullahrahim.me:8000/slack/connect (This is the  endpoint of your app where slack will redirect to send oath token (if its necessary) ) <br />
SLACK_BOT_TOKEN=*** (removed as i pushed on git and received message from slack :)) <br />

Followed the Slack Documentation.

https://api.slack.com/events-api

2. You will need to create an app for your workspace on slack. <br />

When you will be done  creating app, you have to enter **Redirect URL** under **OAuth & Permissions** left menu.

Copy the **Bot User OAuth Access Token** TO .env **SLACK_BOT_TOKEN** key from the same **OAuth & Permissions** menu.

Copy **CLIENT ID** and **CLIENT SECRET** from Basic Info Tab of **settings** menu (App Credentials)

Run the application and Put you URL of your application append **"/calculate"** in the url 
https://api.slack.com/apps/{YOUR_APP_ID}/event-subscriptions?

Hurray!!
See It in Action
![](giphy.gif)