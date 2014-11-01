# Overview

IXP Manager can use [sflow](http://www.sflow.org/) data to build peer-to-peer traffic graphs and traffic aggregate analysis of bytes/packets, split by VLAN and protocol (IPv4 / IPv6), for both individual IXP peering ports, and for entire VLANs.

# Methodology

Similar to netflow, sflow needs to be configured using an accounting perimeter.  This means that ingress sflow accounting should be enabled on all edge ports, but on none of the core ports.  If it's enabled on any of the core ports, traffic will be double-counted which leads to inaccuracy.

Each switch on the network sends sampled sflow packets to an sflow collector.  These packets are processed by the "sflowtool" command, which converts into an easily-parseable ascii format.  IXP Manager provides a perl script to take the output of the sflowtool command, correlate this against the IXP database and to use this to build up a matrix of traffic flows which are then exported to RRD format.

The RRD files are stored on disk and can be accessed either by home-grown code or else by using the sample sflow grapher included in IXP Manager.

# Switch Configuration

Many vendors support sflow, but some do not.  There is a [partial list](http://www.sflow.org/products/network.php) on the sflow web site.  Unfortunately, IXP Manager does not support netflow data export for traffic analysis.

Sflow uses data sampling.  This means that the results it produces are not 100% correct, but on a large data sets, it tends to be quite accurate.  Each switch needs to be configured to have a particular sampling rate. The exact rate chosen will depend on the traffic levels on the switch, how powerful the switch management plane CPU is, and how much bandwidth is available for the switch management.

On a small setup with relatively low levels of traffic (e.g. 100kpps), it would be useful to leave the sampling rate very low (e.g. 1:256).  If the switch or the entire network is handling very large quantities of traffic, this figure should be high enough that IXP ports with low quantities of traffic will still get goot quality graphs, but low enough that the switch management CPU isn't trashed, and that packets are not dropped on the management ethernet port.

Some switches have automatic rate-limiting built in for sflow data export.

### Brocade TurboIron 24X

By default a TIX24X will export 100 sflow records per second.  This can be changed using the following command:

    SSH@Switch# dm device-command 2762233
    SSH@Switch# tor modreg CPUPKTMAXBUCKETCONFIG(3) PKT_MAX_REFRESH=0xHHHH

... where HHHH is the hex representation of the number of sflow records per second.  INEX has done some very primitive usage profiling which suggests that going above ~3000 sflow records per second will trash the management CPU too hard, so we use PKT_MAX_REFRESH=0x0BB8.  Note that this command is not reboot persistent, and any time a TIX24X is rebooted, the command needs to be re-entered manually.

# RRD Requirements

Each IXP edge port will have 4 separate RRD files for recording traffic to each other participant on the same VLAN on the IXP fabric: ipv4 bytes, ipv6 bytes, ipv4 packets and ipv6 packets.  This means that the number of RRD files grows very quickly as the number of IXP participants increases.  Roughly speaking, for every N participants at the IXP, there will be about 4*N^2 RRD files.  As this number creates extremely high I/O requirements on even medium sized exchanges, IXP Manager requires that rrdcached is used.

# Server Overview

As sflow can put a reasonably high load on a server - via sflow data bandwidth, collector CPU requirements, disk I/O and disk space for RRD files - it may be a good idea to have a separate server to handle the IXP's sflow system.

The sflow server will need:

* a web server with php5 support
* a copy of sflowtool
* git
* subversion
* rrdtool + rrdcached
* php5-mysql
* perl 5.10.2 or later
* the following perl modules: DBI, Net::IP, Config::General, RRDs
* mrtg (for Net_SNMP_util)
* a filesystem partition with enough disk space, mounted noatime, nodiratime.  You may also want to consider disabling filesystem journaling.

# Configuration

* Install the open source packages mentioned above.  On FreeBSD, these can be bulk installed using the following command.

> portinstall apache22 sflowtool git devel/subversion databases/rrdtool php5-pdo_mysql mrtg p5-Daemon-Control p5-Config-General p5-NetAddr-IP p5-DBD-mysql

* Install IXP Manager using the instructions provided in [the IXP Manager wiki](Installation-02-Downloading), including the third party libraries.  You can ignore Doctrine, as it's not required by the sflow module.
* Install the IXPManager perl library in the `tools/perl-lib/IXPManager` directory (`perl Makefile.PL; make install`)
* customize the `application/configs/application.ini` configuration file as required, particularly the sflow.* section.
* configure and start `rrdcached`.  We recommend using journaled mode with the `-P FLUSH,UPDATE -m 0666 -l unix:/var/run/rrdcached.sock` options enabled.  Note that these options allow uncontrolled write access to the RRD files from anyone on the sflow machine.
* on FreeBSD it is a good idea to set `net.inet.udp.blackhole=1` in /etc/sysctl.conf, to stop the kernel from replying to unknown sflow packets with an ICMP unreachable reply.

