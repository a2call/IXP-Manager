We now need to use Doctrine to set up the tables (schema).

## Setting the Application Environment

A lot of the tools in `bin/` make use of `bin/utils.inc` which reads the application environment (`APPLICATION_ENV`) from `public/.htaccess` and this environment should correspond to the section in `application/config/application.ini` that you wish to use (e.g. `production`, `development`, etc).

Even if you plan to set these details in an Apache virtual host configuration, create this `.htaccess` file anyway so `utils.inc` can read the intended environment:

    cp public/.htaccess.dist public/.htaccess

and then edit as appropriate.


## Creating the Schema

If everything is set up correctly, the following (assuming you are in the `bin/` directory) should created your database:

    ./doctrine2-cli.php orm:schema-tool:create
    ATTENTION: This operation should not be executed in a production environment.
    
    Creating database schema...
    Database schema created successfully!


If it fails, please contribute to the *Possible Errors* section below.

## Creating Views

Once the database has been set up, you will need to create the SQL views used by various back-end systems.  This can be done as follows:

    $ mysql -u root -p password [dbname] < tools/sql/views.sql

## Schema Diagrams

Schema diagrams are available [here](https://github.com/inex/IXP-Manager/tree/master/data/schemas).

## Next Steps

Continue you installation with [Setting up Apache](Installation-06-Apache-Setup)

## Possible Errors

### Script fails with "PHP Fatal error:  Class 'Memcache' not found in ..."

    # ./doctrine2-cli.php orm:schema-tool:create
    PHP Fatal error:  Class 'Memcache' not found in /usr/local/ixp/library/OSS-Framework.git/OSS/Resource/Doctrine2cache.php on line 101

    Fatal error: Class 'Memcache' not found in /usr/local/ixp/library/OSS-Framework.git/OSS/Resource/Doctrine2cache.php on line 101


**Answer: Install the memcache extension module for PHP5 and try again.**

Example (for Ubuntu/Debian):

``apt-get install php5-memcache``

***
### Script fails with "PHP Parse error: syntax error, unexpected '[' ..."

   ./doctrine2-cli.php orm:schema-tool:create

   PHP Parse error:  syntax error, unexpected '[' in /usr/local/ixp/library/OSS-Framework.git/OSS/Resource/Doctrine2.php on line 88 


**Answer:  PHP is not at version 5.4 or higher.**

***