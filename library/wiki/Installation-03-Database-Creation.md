IXP Manager requires a MySQL(*) database. In this step we will just create the database and access details, in a later step we will use Doctrine to create the schema.

(*) Doctrine ORM uses a Database Abstraction Layer (DBAL) meaning that [any supported database](http://www.doctrine-project.org/projects/dbal.html) by Doctrine should work fine but we have used MySQL exclusively.


## Database and User Creation

Use whatever means you like to create a database and user for IXP Manager. For example:

    $ mysql -u root -p
    mysql> CREATE DATABASE `ixp`;
    mysql> GRANT ALL ON `ixp`.* TO `ixp`@`127.0.0.1` IDENTIFIED BY 'password';
    mysql> FLUSH PRIVILEGES;


## Schema Diagrams

Schema diagrams are available [here](https://github.com/inex/IXP-Manager/tree/master/data/schemas).

## Next Step

Continue you installation with [Configuring IXP Manager](Installation-04-Configuration).