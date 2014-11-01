Switch and switchport details can be updated automatically via SNMP using a cronjob such as:

    10 * * * * /path/to/ixp-manager/bin/ixptool.sh -a switch-cli.snmp-poll

This will echo any changes to stdout. If there are no changes and no errors then no information is printed. Possible options include:

* `-v` - verbose output
* `-p switch=$name` where `$name` is the switch name as defined in the switch table. Without this parameter, all active switches are polled.
* `-p noflush=1` performs a dry run with no details saved to the database.

**NB:* If using multiple `-p` options, separate them with a comma such as: `-p switch=$name,noflush=1`.


# Switch Details

Details such as operating system and version are gathered.

The information gathered by this is visible on the _Switch_ page (select _Switches_ on the left menu) and then click the _OS View_ button on the top right.

# SwitchPort Details

This same script will also poll all switch ports and:

* update details such as ifAlias, operational and admin states, speeed, etc;
* alert on new ports found;
* alert of ports that have disappeared.

These details can be seen on the _Operation View_ of the SwitchPort controller (select _Switches_ and then _Switch Ports_ on the left).

