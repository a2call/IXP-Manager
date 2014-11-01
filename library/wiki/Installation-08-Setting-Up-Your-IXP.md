At this point, you should be able to log into your **IXP Manager** using the administrative user you defined in the `fixtures.php` file from the previous step.

You now need to start adding the nuts and bolts of your IXP into **IXP Manager**.

## Documentation Deficit

**The documentation from here in may get a little sketchy but we'll build it up as we assist IXPs implementing IXP Manager. Please do this with us via the mailing list.**

## Schema Diagrams

Schema diagrams are available [here](https://github.com/inex/IXP-Manager/tree/master/data/schemas). These may help with understanding the below.

## Setting Up Your Physical Infrastructure

You can start by adding the following objects under the **IXP ADMIN ACTIONS** menu on the left.

* Locations - data centres / points of presence of your IXP.
* Cabinets - racks in these data centres.
* Switches - your peering switches.

When adding switches, you'll have to enter an *infrastructure*. At INEX, [we have two physically diverse](https://www.inex.ie/technical/netdiagram) infrastructures. If you only have one, enter `1`. For more, just use increasing integers. You can also use these of your ISP has separate peering LANs in multiple cities for example.

* Switch ports - the ports on your switches; this needs to be documented as data entered here is used by various backend systems such as MRTG.
* VLANs - on our infrastructures, we have multiple peering LANs. For example, we have the *primary peering LANs* and then some specialised ones such as *jumbo frame peering LAN* and *VoIP peering LAN*. You will need to create at least on peering LAN here.
* IP Addresses - add your ranges of IPv4 and v6 addresses to your peering LANs here.

You now need to describe your peering LANs - for now this this a manual step:

## Network Info

There is a table in the database called ''networkinfo'' which describes the peering LAN. It is best to explain this by showing the true IPv4 and IPv6 entries for INEX's primary VoIP peering LAN:

    mysql> select * from networkinfo where vlanid = 6\G
    *************************** 1. row ***************************
            id: 5
        vlanid: 6
      protocol: 4
       network: 194.88.241.0
       masklen: 26
    rs1address: 194.88.241.8
    rs2address: 194.88.241.9
       dnsfile: /opt/bind/zones/reverse-vlan-70-ipv4.include
    *************************** 2. row ***************************
            id: 6
        vlanid: 6
      protocol: 6
       network: 2001:07F8:0018:70::
       masklen: 64
    rs1address: 2001:7f8:18:70::8
    rs2address: 2001:7f8:18:70::9
       dnsfile: /opt/bind/zones/reverse-vlan-70-ipv6.include
    2 rows in set (0.00 sec)

You'll need to add these manually for now as we have no frontend on this table. Most of the above should be self-explanatory:

* ''vlanid'' is the primary key from the ''vlan'' table;
* protocol is either IPv**4** or IPv**6**;
* ''network'' is the network address;
* ''masklen'' is the CIDR mask length;
* ''rs[12]address'' is the address of the primary and secondary route servers;
* ''dnsfile'' is used by a script to populate the inverse / rDNS entries for peering addresses.

## Adding Customers, Contacts, Users and Ports

* [Customers / Members](Customers)
* [Contacts and Users](Contacts-and-Users)
* [Ports](Ports)


## Backend Provisioning and Tasks

These are just some of the backend automatic provisioning / configuration tasks that the IXP Manager database provides:

* MRTG Integration
* Route Collector configuration
* Route Server configuration
* AS112 configuration
* RADIUS authentication provisioning
* TACACS authentication provisioning
* Console server provisioning
* Smokeping configuration
* Nagios configuration
* IXP Staff email
* DNS zone population

**All of these need to be documented.**