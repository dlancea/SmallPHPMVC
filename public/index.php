<?php
/**
 * Main index.php. All requests go through here
 *
 * Every page request is routed through this script, which loads the appropreate controller.
 * Also loads all globally required libraries.
 * 
 * The structure for this app is from:
 * http://www.phpit.net/article/simple-mvc-php5/
 *
 * @package		Links
 */

# Startup tasks
chdir('..');

session_start();

require 'inc/bootstrap.php';
require 'inc/functions.php';

// Globals
$registry = MVC_Registry::getReg();

# Connect to DB
$mongo = new Mongo();
$db = $mongo->tracker;
$registry->set('db', $db);

# Load template object
$template = new MVC_Template();
$registry->set ('template', $template);

# Load router
$router = new MVC_Router();
$registry->set ('router', $router);
$router->setPath (CONTROLLER_PATH);
$router->delegate();
