<?php
/*
Plugin Name: MSPluginBoilerplate
Plugin URI: https://www.sitko-designing.de
Description: MS Plugin Boilerplate is a MVC-Pattern boilerplate for WordPress-Plugin development. It requires the ClassLoader
Version: 1.0.1
Author: Mark Sitko
Author URI:  https://www.sitko-designing.de
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mspb
 */

namespace mspb;

use mspb\MSPluginBoilerplate;
use db\wp\loader\ClassLoader;

ClassLoader::instance()->add(__NAMESPACE__, __DIR__ . '/src');

MSPluginBoilerplate::instance();