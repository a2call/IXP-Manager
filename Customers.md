*Documentation Required*


## Types of Customer

See the [entity definitions here](https://github.com/inex/IXP-Manager/blob/master/application/Entities/Customer.php).

* `TYPE_FULL` - a standard member / customer of an IXP;
* `TYPE_ASSOCIATE` - a non-trafficing associate member. See [INEX's Associate program](https://www.inex.ie/joining/associate); not unlike EURO-IX patrons.
* `TYPE_INTERNAL` - internal IXP *members* - for example route collectors (which would typically come under the customer you created in the `fixtures.php` stage); route servers using their own ASN.
* `TYPE_PROBONO` - typically free memberships for the benefit of the exchange. E.g. the [AS112 project](http://public.as112.net/).

