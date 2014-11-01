IXP Manager of pre-April 2013 had separate contacts and users. [LONAP](http://www.lonap.net/) sponsored a much needed rework of this and now all users are contacts with login privileges. The interface still allows listed of these separately but all links for adding / editing / deleting will _do the right thing_.





## Types of Users

See the entity definitions [here](https://github.com/inex/IXP-Manager/blob/master/application/Entities/User.php).

There are four types of user:

* `AUTH_PUBLIC` - not actually used at this point.
* `AUTH_CUSTUSER` - a standard customer user with portal access.
* `AUTH_CUSTADMIN` - a customer administrative user. The only purpose of this account is to allow customers to created, edit and remove their own users. No other access is available through a CUSTADMIN login. Think of it as a RIPE admin account.
* `AUTH_SUPERUSER` - IXP staff only. **FULL ACCESS TO ALL CUSTOMERS AND FUNCTIONS**. This is only for your IXP staff!


## Logging in as Another User

Administrative users can *switch to* other users to *see what they see* via the user list or the customer overview page.