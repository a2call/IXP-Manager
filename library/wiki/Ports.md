*Documentation Needed*

*Ports* are actually made up of:

* a *virtual interface* which is the containing entity to which you add:

  * *physical interfaces* - which in turn are connected to *switch ports*. Multiple physical interfaces in a virtual interface indicate a LAG port.
  * *VLAN interfaces* - the peering LANs that this virtual interface can access as well as IP addressing details, BGP secrets, route server enabled, etc.

You can manually add these or you can use the **Ports -> Quick Add** option.
