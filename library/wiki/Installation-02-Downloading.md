When downloading and installing IXP Manager, you should fork and clone directly from Github.

In this documentation, we will assume you choose to fork and clone from Github.

## Forking and Cloning from Github

If you have not already done so, create an account for yourself / your organisation on [GitHub](https://github.com/).

Then browse to [IXP Manager](https://github.com/inex/IXP-Manager) and click **Fork** on the top right ([direct link](https://github.com/inex/IXP-Manager/fork_select)).

Once forked, your clone URL will be something like one of the following (Git protocol and HTTPS):

    git@github.com:{$HANDLE}/IXP-Manager.git
    https://github.com/{$HANDLE}/IXP-Manager.git

where ``{$HANDLE}`` is your username / organisation username.

Log into the server where you wish to install IXP Manager.

Move to the directory where you wish to store the source. Note that it **should not** be checked out into any web exposed directory (e.g. do not checkout to `/var/www`). In my case, I'm going to use `/usr/local/ixp` so I:

    cd /usr/local
    git clone git@github.com:{$HANDLE}/IXP-Manager.git ixp


As it stands, there is only one branch of interest: **master** - this reflects tagged stable releases with features added on a continuous basis via the [GitHub Flow model](http://www.barryodonovan.com/index.php/2012/07/03/two-git-branching-models).

You should try to avoid using your own **master** branch and keep that for pulling conflict free updates from INEX's canonical repository. Instead, create a new branch now for your own IXP:

    cd /usr/local/ixp
    git checkout -b production
    git push origin production

You can now develop / edit your production branch and push changes back to your own fork on GitHub.

Regularly *pulling* from our master will keep you up to date. Any other branches on our repository are typically feature branches representing work in progress.


## Committing Code Back to INEX

We are open sourcing **IXP Manager** in the hopes that the wider community will help the project grow. If you have bug fixes, new features, etc, please merge those changes into your **master** branch and then open a pull request with INEX's repository.

If you want to discuss new features in advance, please contact us on the mailing list.

## Install Third Party Libraries

IXP Manager requires a number of third party libraries as outlined in the [requirements page](https://github.com/inex/IXP-Manager/wiki/Installation---Requirements).

Some of the required libraries (especially Zend, Smarty and Doctrine) are often available as packages with Linux / BSD distributions. You are free to use these packaged versions and link to them from the `library/` directory. However, these may (and often are) updated out of step with IXP Manager - so, for maximum stability you are strongly advised to use out methods below.

All of the libraries bar one can be installed by executing the following commands:

    cd /usr/local/ixp
    ./bin/library-init.sh

This will download and install all the required libraries under `library/`.

These libraries can be updated later using `bin/library-update.sh`.

Doctrine ORM 2.3 is installed using PHP PEAR:
    
    pear channel-discover pear.symfony.com
    pear channel-discover pear.doctrine-project.org
    pear install doctrine/DoctrineORM

I've found a quirk here which requires a symbolic link to be added. Find the Doctrine directory where the above was installed:

* for Ubuntu: `/usr/share/php/Doctrine`
* for FreeBSD: `/usr/local/share/pear/Doctrine`

and then (using Ubuntu as an example):

    cd /usr/share/php/Doctrine
    ln -s ../Symfony


## Next Step

Continue you installation with [Creating a Database](Installation-03-Database-Creation).