IXP Manager supports template skinning allowing users to substitute any of their own templates in place of the default ones used by INEX. 
To use skins, proceed as follows:

1. set a skin name in `application/configs/application.ini`:

    resources.smarty.skin      = "myskin"

2. create a directory with a matching name: `application/views/_skins/myskin`.


Once the ``application.ini`` skins option is set, then any pages in its skin directory (using the same directory structure as `application/views` will take precedence over the default template files. This means you do not need to recreate / copy all the default files - just replace the ones you want.






