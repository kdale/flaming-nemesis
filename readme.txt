Team Banana - Ueubung 6

The provided framework (from class) was used for this exercise.

Followed a normal localhost set up (set up as desired on local machine), for example:
- www as webroot

- hosts entry: 
127.0.0.1       mensaplan

- httpd_vhosts.config entry:
<VirtualHost *:80>
    DocumentRoot "/www/mensaplan/public_html"
    ServerName mensaplan
</VirtualHost>

