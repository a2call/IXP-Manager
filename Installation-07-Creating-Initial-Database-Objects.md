Unfortunately, this is where our installation process falls down a little!

We'd like to have a nice automated installer here but for now, you'll need to use a little script we have created. First edit some settings:

    cd bin
    cp fixtures.php.dist fixtures.php
    vi fixtures.php


When you edit `fixtures.php`, skip to **MODIFY YOUR FIXTURES HERE**. What you are creating is:

* the initial customer entry which is your IXP.
* the initial administrative user.

You need to edit these objects in `fixtures.php` to match your own scenario.

In order to avoid subtle access issues (having already set files as owned by the web user) it is wise to set the script's owner and run it as the web user:

    chown www-data fixtures.php
    sudo -u www-data ./fixtures.php

although you may get away with just doing:

    ./fixtures.php


## Next Steps

Continue your installation with [Setting Up Your IXP](Installation-08-Setting-Up-Your-IXP).