<?php
/*
Plugin Name: WP MyPlugin Plugin 
Plugin URI: https://www.sitko-designing.de
Description: WP MyPlugin Plugin is a MVC-Pattern boilerplate for WordPress-Plugin development. It requires a ClassLoader
Version: 0.0.1
Author: Mark Sitko
Author URI:  https://www.sitko-designing.de
License: LGPL v3
Text Domain: mp
*/

namespace mp;

use mp\MyPlugin;
use db\wp\loader\ClassLoader;

ClassLoader::instance()->add(__NAMESPACE__, __DIR__ . '/src');

MyPlugin::instance();