**INTRODUCED:** 20130524 - V3.0.13 (largely sponsored by [LONAP](http://www.lonap.net/))

Customer ports are known as _Virtual Interfaces_ in IXP Manager and a virtual interface is made up of a _VLAN Interface_ and a _Physical Interface_. When a physical interface is added, it must be linked with a physical _SwitchPort_ belonging to a _Switch_.

## Adding Switches and Switch Ports

Switches are added by polling a switch via SNMP (v2c) to discover its make, model, OS details and ports. This is done using the [OSS_SNMP library](https://github.com/opensolutions/OSS_SNMP/wiki). It is required that this library can discover your platform - you can see [the platforms that are supported here](https://github.com/opensolutions/OSS_SNMP/tree/master/OSS_SNMP/Platforms) and [how to add new ones here](https://github.com/opensolutions/OSS_SNMP/wiki/Device-Discovery) (please ensure to contribute back to OSS_SNMP!). It is possible to add switches without SNMP polling but this is strongly discouraged as SNMP is built heavily into the switch and switch port management.

As part of the process of adding switches, its ports are discovered and added automatically.

If you have issues with adding switches by SNMP, you are advised to post to the mailing list first as adding and managing switches and ports without SNMP is not well documented.

## Keeping Switch and Switch Ports Updated

See [this page](Updating-Switches-and-Ports-via-SNMP) for details of how to set up a cron job to regularly poll your switches to keep switch details up to date. If nothing changes, there us no output but it will output information such as:

* new switch OS version found
* new ports found
* ports existing only in the database and not on the switch found
* port state changes (operational and admin status, duplex, speed, etc)

This can be useful for monitoring your infrastructure.

## Port Types

Switch ports are assigned types [as defined here](https://github.com/inex/IXP-Manager/blob/master/application/Entities/SwitchPort.php#L13). This is important as, for example, only peering ports are offered as an option when assigning a port to a physical interface.

In the future, we'd like to generate Nagios and other configurations based on core (inter-switch) ports.

## Browsing / Viewing Your Switches in IXP Manager

### Switch Information

When you select _Switches_ from the left menu, you will be presented with a searchable list of all your switches. Note that on the top right there is an _OS View_ button which will show switch information as gathered by SNMP using [the cron job](Updating-Switches-and-Ports-via-SNMP) (also updated via the SNMP port view discussed below).

On the right of each switch entry is a dropdown menu offering a number of views of the switch ports:

### Switch Port Information

* **View / Edit Ports (with SNMP poll)** - this is possibly the most useful view. It performs an immediate switch and switch port update via SNMP (including identifying new ports and ports that exist only in the database). On this page you can update ports in bulk to set their type, whether they are active or not and delete database only ports. Note that if you delete a port that does exist on the switch, it'll just be added in again when polled next.

* **View / Edit Ports (database only)** - similar to the above, it displays switch ports but uses the existing database entries as its source only. This is primarily legacy but useful if, for example, the switch is offline.

* **View Live Ports States (with SNMP poll)** - also extremely useful in that it performs an immediate SNMP poll and displays port information such as speed, MTU, operational and admin state, name, description and alias.

* **View Port Report** - displays a basic port report with a customer list. Needs more work but useful as a printable report for performing on site maintenance for example.
