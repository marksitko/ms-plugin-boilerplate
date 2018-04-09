<?php
/*
Plugin Name: WP Skeleton Plugin 
Plugin URI: https://www.sitko-designing.de
Description: WP Skeleton Plugin is a MVC-Pattern boilerplate for WordPress-Plugin development. It requires a ClassLoader
Version: 0.0.1
Author: Mark Sitko
Author URI:  https://www.sitko-designing.de
License: LGPL v3
Text Domain: wpps
*/

namespace wpps;

use wpps\Skeleton;
use db\wp\loader\ClassLoader;

ClassLoader::instance()->add(__NAMESPACE__, __DIR__ . '/src');

Skeleton::instance();