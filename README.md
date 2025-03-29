C:\xampp\apache\conf\httpd.conf

Set your line 250ish to your project directory to make sure that html links work.

For example:

>DocumentRoot "C:/xampp/htdocs/www/termproject"

><Directory "C:/xampp/htdocs/www/termproject">


Additionally, dont forget to do "npm install" to install the npm dependencies.

You need to make a database called "client". You do no need to make a table for that database, as I have implemented code to automatically do that. If you cannot make the database for some reason, tell me so that I can export a database to you.


SYNCHRONIZE CHANGES TO BE ABLE TO PUSH CHANGES

do this in source control VSCODE
