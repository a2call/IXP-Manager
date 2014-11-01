**INTRODUCED:** 20130410 - V3.0.9 (sponsored by [LONAP](http://www.lonap.net/))

Contacts can no be assigned to multiple arbitrary groups.

## Creating / Editing / Deleting Groups

A group is defined by:

* a name (e.g. _beer_);
* a type (e.g. _Likes_); and
* a description (e.g. _Contacts in this group like to drink beer_).

You define the group types in `application.ini` such as:

    contact.group.types.ROLE  = "Role"
    contact.group.types.LIKES = "Likes"

In these examples, `ROLE` will be entered in the database column and _Role_ will be displayed in the interface.

Groups can then be added / edited / deleted via `ixp/contact-group`. This can be reached by clicking _Contacts_ and then _Contact Groups_ in the left menu.

## Assigning Contacts to Groups

Assigning contacts to groups is done in the contact add / edit page.


## Exporting Contact Groups

Contact groups can be exported using the `ixptool.php` command, for example:

    bin/ixptool.php -a cli.cli-export-group -p type=ROLE,format=csv,cid=1

where the possible comma separated parameters are:

* `type=XXX`: Contact group type (e.g. `ROLE`); or
* `name=XXX`: Contact group name (e.g. `beer`).

* `format=XXX`: Output format - one of `json` (default) or `csv`

* `sn`: Customer shortname to limit results to; or
* `cid`: Customer id to limit results to.


## Special Group: Roles

The default `application.ini` and the `fixtures.php` script creates a `ROLE` group type populated with groups _Admin, Billing, Technical_ and _Marketing_. There is a dedicated form element when editing contacts for any groups defined in the Role type. 

If the role type is removed from `application.ini`, the form element for the contact's roles will not be shown.

