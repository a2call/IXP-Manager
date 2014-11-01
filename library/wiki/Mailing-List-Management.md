IXP Manager has the ability to allow its users to subscribe / unsubscribe from Mailman mailing lists (it should be relatively easy to expand this to other mailing list managers).

The following sections explain the steps in how this is set up.

**NB:** This facility does not perform a 100% syncronisation. Any mailing list members that are added separately without a matching user in IXP Manager are not interfered with.

## Configuring Available Mailman Lists

In `application.ini`, add an appropriate configuration such as:

    ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;    
    ;; Mailing List Subscription Management Facility
    
    ; enable mailing list management
    mailinglist.enabled = 1
    
    ; define the first available mailing list
    mailinglists.listname1.name    = "A Mailing List"
    mailinglists.listname1.desc    = "Description for the list."
    mailinglists.listname1.email   = "listname1@example.com"
    mailinglists.listname1.archive = "https://www.example.com/mailman/private/listname1/"
    
    ; define another mailing list (and as many as you like)
    mailinglists.listname2.name    = "Another Mailing List"
    mailinglists.listname2.desc    = "Description for the second list."
    mailinglists.listname2.email   = "listname2@example.com"
    mailinglists.listname2.archive = "https://www.example.com/mailman/private/listname2/"
    mailinglists.listname2.syncpws = false

    ; The follow three commands are used to syncronise the mailing list with IXP Manager
    mailinglist.cmd.list_members   = "/usr/local/mailman/bin/list_members"
    mailinglist.cmd.add_members    = "/usr/local/mailman/bin/add_members -r -"
    mailinglist.cmd.remove_members = "/usr/local/mailman/bin/remove_members -f - -n -N"
    mailinglist.cmd.changepw       = "/usr/local/mailman/bin/withlist -q -l -r changepw"

There are three main sections to the above:

1. The statement to enable mailing list management. If this is not set, the user will not be offered subscription options and the CLI commands will not execute.

2. The list definitions. The `listname1` and `listname2` keys in the configuration variable name are important and must match the Mailman list key also as it is this name that is used by the commands. The parameters are used to provide the user with list information and links. Mailing list passwords are also sync'd from the IXP Manager user database *unless* `syncpws` is both defined and false for the given list.

3. The location of the specified mailman commands which is used by the syncronisation script generator (see below).

## Explanation of Usage

This mailing list syncronisation / integration code was written for existing Mailman lists we have at INEX where some lists are public with subscribers that will never have an account on INEX's IXP Manager. As such, these scripts are written so that email addresses in common between IXP Manager and Mailman can manage their subscriptions in IXP Manager but those other subscribers will be unaffected.

Users in IXP Manager will either be marked as being subscribed to a list, not subscribed to a list or neither (i.e. a new user). Subscriptions are managed by user preferences of the format:

    mailinglist.listname1.subscribed = 0/1


There are four steps to performing the syncronisation **for each list** which are done using the IXP Manager CLI script `bin/ixptool.php`:


1. The execution of the `cli.mailing-list-init` script which is really for new IXP Manager users (or initial set up of the mailing list feature). This script is piped the full subscribers list from Mailman (via `list_members`). This function will iterate through all users and, if they have no preference set for subscription to this list, adds either adds a not subscribed preference if their email address is not in the provided list of subscribers or a subscribed preference if it is.

2. The execution of the `cli.mailing-list-subscribed` action which lists all users who are subscribed to the given mailing list based on their user preferences. This is piped to the `add_members` Mailman script.

3. The execution of the `cli.mailing-list-unsubscribed` action which lists all users who are unsubscribed to the given mailing list based on their user preferences. This is piped to the `remove_members` Mailman script.

4. The execution of the `cli.mailing-list-password-sync` action which sets the mailing list password for  all users who are unsubscribed to the given mailing list based on their IXP Manager user password. This action `exec()` the change password command directly. **See Password Syncronisation below.**


## How to Implement

You can implement mailing list management by configuring IXP Manager as above. Then execute the following command:

    bin/ixptool.php -a cli.mailing-list-sync-script >bin/mailing-list-sync.sh

This generates a script called ``mailing-list-sync.sh`` which performs each of the above 3 steps for each configured mailing list. If your mailing list configuration does not change, you will not need to rerun this.

You should now put this script into crontab and run as often as you feel is necessary. The current *success* message for a user updating their subscriptions says *within 12 hours* so we'd recommend at least running twice a day.


## Password Syncronisation

By default, passwords from IXP Manager users with mailing list subscriptions will be sync'd to Mailman. 

This is done via the Mailman `withlist` script and it requires a `changepw.py` script to be in the same directory as `withlist` and this script is not supplied by default (although it is documented). Create the following `changepw.py` in the same directory as `withlist`:

    from Mailman.Errors import NotAMemberError
    
    def changepw(mlist, addr, newpasswd):
        try:
            mlist.setMemberPassword(addr, newpasswd)
            mlist.Save()
        except NotAMemberError:
            print 'No address matched:', addr


## Todo

* better handling of multiple users with the same email address and documentation of same
* user changes email address
 

    
