SmallPHPMVC
=============

This is a small MVC framework I've been using on personal projects for a while. It was based on a write-your-own-MVC-framework tutorial which used to be here: (http://www.phpit.net/article/simple-mvc-php5/), but unfortunately that site no longer exists.

I'd consider this code "alpha" so use at your own risk. I'll likely be adding and changing things around which are not backwards compatible. However, it's still a solid, unbloated framework for small apps, or a nice starting point for creating your own framework.

To get started quickly there's an application template using this library located on GitHub here: https://github.com/dlancea/SmallPHPMVC-App-Template

What's included?
----------------

Only the actual library files. 

* Registry, which provides system-wide configuration and resource access.
* Bootsrap, which sets up path constants, sets up registry, and loads and runs Router
* Router, which routes the application to the appropriate controller/action.
* BaseController, the abstract parent of all application controllers.
* Template, which allows template files to be loaded with access to data specifically set in the class.
* Layout, an extension of the Template class, is used to create site-wide layouts.

As of now there is no "Model" part of the MVC provided. I've left it out because models can be so different app-to-app, and I didn't want to assume a simple CRUD interface for everything.

Todo
----

* Make router HTTP-Request-Method-aware to allow for RESTful routing.
* Unit testing
[![githalytics.com alpha](https://cruel-carlota.pagodabox.com/c892c2bee189072c2ab94c752bb6a81b "githalytics.com")](http://githalytics.com/dlancea/SmallPHPMVC)
