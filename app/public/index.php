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

require '../../lib/smallphpmvc/bootstrap.php';

SmallPHPMVC\Bootstrap::initialize();