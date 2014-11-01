The frontend of IXP Manager is a PHP application which requires:

* a Linux / BSD host (Windows may be possible but we have not developed or ran IXP Manager on this platform);
* MySQL (any modern version >5 should suffice, we have developed and run on versions from 5.3);
* Apache (this is the only web server we have developed and run on, sorry Nginx users);
* PHP 5.4 (NB: this code will not run on older versions. 5.4 is standard on current FreeBSD and Ubuntu);
* Memcached (optionally but very very recommended)

To complete the installation using the included config/scripts, you will also need to have installed:

* A text editor such as joe, vi, nano, emacs, pico
* **git** - distributed revision control system (e.g.: apt-get install git)
* **subversion** - Advanced version control system (e.g.: apt-get install subversion)
* **memcache extension module for PHP5** (e.g.: apt-get install php5-memcache)
* **php-apc** - APC (Alternative PHP Cache) module for PHP 5 (e.g.: apt-get install php-apc)
* **php-mbstring** - may be built into the PHP core
* PHP database libraries for your chosen database

In addition to this, there are a number of third party libraries required. Do not install them in advance - you'll be instructed to do this during the installation process and there are some scripts to make it easier.

The libraries required for the MVC architecture are:

* Model: [Doctrine ORM 2.3](http://www.doctrine-project.org/)
* View: [Smarty](http://www.smarty.net/) (V3 or later)
* Controller: [Zend Framework](http://framework.zend.com/) (>= V1.12; ZF2 will not work)

And these are augmented with:

* [Bootbox](http://bootboxjs.com/) - extends Bootstrap's model dialog;
* [Bootstrap-Zend-Framework](https://github.com/inex/Bootstrap-Zend-Framework) - styles Zend forms using Bootstrap;
* [OSS-Framework](https://github.com/opensolutions/OSS-Framework) - a library of useful extensions to ZF by [Open Solutions](http://www.opensolutions.ie/); 
* [Minify[(https://github.com/opensolutions/Minify) - a tool to make minimising and packing JS and CSS files into bundles easier (optional).


Then, we additionally use the following which are included in our Git source:

* Twitter [Bootstrap](http://twitter.github.com/bootstrap/)
* [jQuery](http://jquery.com/)
  * [jQuery UI](http://jqueryui.com/)
  * [DataTables](http://datatables.net/)
  * [ColorBox](http://www.jacklmoore.com/colorbox)
  * [Chosen](http://harvesthq.github.com/chosen/)
  * [Throbber.js](http://aino.github.com/throbber.js/)
  * and a few smaller libraries (which can be found under `public/js/`

## Next Step

Continue you installation with [Downloading and Installing IXP Manager and Required Libraries](Installation-02-Downloading).