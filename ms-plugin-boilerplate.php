<?php
/*
Plugin Name: MS Plugin Boilerplate
Plugin URI: https://www.sitko-designing.de
Description: MS Plugin Boilerplate is a MVC-Pattern boilerplate for WordPress-Plugin development. It requires a ClassLoader
Version: 0.0.1
Author: Mark Sitko
Author URI:  https://www.sitko-designing.de
License: LGPL v3
Text Domain: mspb
*/

namespace mspb;

use mspb\MSPluginBoilerplate;
use db\wp\loader\ClassLoader;

ClassLoader::instance()->add(__NAMESPACE__, __DIR__ . '/src');

MSPluginBoilerplate::instance();