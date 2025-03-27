C:\xampp\apache\conf\httpd.conf

Set your line 250ish to your project directory to make sure that html links work.

For example:

>DocumentRoot "C:/xampp/htdocs/www/termproject"

><Directory "C:/xampp/htdocs/www/termproject">


Additionally, dont forget to do "npm install" to install the npm dependencies.

You do not need to create an SQL databse through phpMyAdmin as I have code that will automatically create the profile database. Though, I am unsure if it will work if you do not have the "client" database.