C:\xampp\apache\conf\httpd.conf

Set your line 250ish to your project directory to make sure that html links work.

For example:

>DocumentRoot "C:/xampp/htdocs/www/termproject"

><Directory "C:/xampp/htdocs/www/termproject">


Additionally, dont forget to do "npm install" to install the npm dependencies if you start messing with scss.

The database and tables are automatically created.


SYNCHRONIZE CHANGES TO BE ABLE TO PUSH CHANGES

do this in source control VSCODE
