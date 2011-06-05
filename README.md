SmallPHPMVC
=============

This is a small MVC framework I've been using on personal projects for a while. It was based on a write-your-own-MVC-framework tutorial which used to be here: (http://www.phpit.net/article/simple-mvc-php5/), but unfortunately that site no longer exists.

I'd consider this code "alpha" so use at your own risk. I'll likely be adding and changing things around which are not backwards compatible. However, it's still a solid, unbloated framework for small apps, or a nice starting point for creating your own framework.

What's included?
----------------

Essentially, the bulk of the code (and by bulk I mean a few hundred lines) is in the 5 library classes:

* Registry, which provides system-wide configuration and resource access.
* Bootsrap, which sets up path constants, sets up registry, and loads and runs Router
* Router, which routes the application to the appropriate controller/action.
* BaseController, the abstract parent of all application controllers.
* Template, which allows template files to be loaded with access to data specifically set in the class.

There is also a Controller\App class in the app/controller directory, which should be the parent of any controller you might write.

The application layout is already included, and follows framework conventions. The "app" directory contains your application specific code, the include folder contains a few setup settings, and lib contains the mvc classes themselves.

Also included is an index controller, and an index template. The index/index controller/action are the default route when nothing else is specified, so they are provided as an example, and to framework in action right from the get-go.

As of now there is no "Model" part of the MVC provided. I've left it out because models can be so different app-to-app, and I didn't want to assume a simple CRUD interface for everything.

Todo
----

* Make router HTTP-Request-Method-aware to allow for RESTful routing.
* Template layouts and an include system from within templates (in progress in layout branch).
* Unit testing
