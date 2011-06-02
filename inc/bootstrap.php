<?php
// Constants:
define ('DIRSEP', DIRECTORY_SEPARATOR);

// Get site path
$SITE_PATH = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define ('SITE_PATH', $SITE_PATH);
define ('INCLUDE_PATH', SITE_PATH.'inc');
define ('LIBRARY_PATH', SITE_PATH.'lib');

define ('APP_PATH', $SITE_PATH . 'app/');
define ('CONTROLLER_PATH', APP_PATH.'controller');
define ('MODEL_PATH', APP_PATH.'models');
define ('TEMPLATE_PATH', APP_PATH.'template');

require SITE_PATH . 'inc/functions.php';

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
