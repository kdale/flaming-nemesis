Team Banana - Exercise 6

The provided php-framework (from class) was used for this exercise.

Site setup:
Installed provided php-framework on localhost (apache install from previous exercise), following standard site setup in apache i.e.

- Copied php-framework to webroot on local machine (in my case www)

- added hosts entry: 
127.0.0.1       mensaplan

- added httpd_vhosts.config entry:
<VirtualHost *:80>
    DocumentRoot "/www/mensaplan/public_html"
    ServerName mensaplan
</VirtualHost>

No additional steps were taken to make the provided php-framework run.

