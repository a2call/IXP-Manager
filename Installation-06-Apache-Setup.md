Create a new virtual host or directory and alias for **IXP Manager** in Apache. Here's a working example:


    Alias /ixp /usr/local/ixp/public
    <Directory /usr/local/ixp/public>
        Options FollowSymLinks
        AllowOverride None
        Order deny,allow
        Allow from all
        
        SetEnv APPLICATION_ENV production
        
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} -s [OR]
        RewriteCond %{REQUEST_FILENAME} -l [OR]
        RewriteCond %{REQUEST_FILENAME} -d
        RewriteRule ^.*$ - [NC,L]
        RewriteRule ^.*$ /ixp/index.php [NC,L]

    </Directory>

Restart apache.

NB: This requires the **rewrite** module to be enabled in apache.

Example (debian): ``ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/``

## Permissions

Apache requires read access to everything under ``/usr/local/ixp``.

However, write access is also required for ``/usr/local/ixp/var``. The easiest thing is to make your web user the owner (or group) of the base directory - with read access, and also with write access for ``var/`` directory:

    chown -R www-data /usr/local/ixp
    chmod -R u+rX /usr/local/ixp
    chmod -R u+w /usr/local/ixp/var


Browsing to `http://hostname/ixp/` should now reveal the IXP Manager login page. Don't try to login yet though - there are more steps to complete first.

**Congratulations!**


## Next Steps

Continue you installation with [Creating Initial Database Objects](Installation-07-Creating-Initial-Database-Objects).