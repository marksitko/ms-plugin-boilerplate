# WordPress Plugin Boilterplate in MVC-Pattern

## What do you offer this Boilerplate?

The `MS Plugin Boilerplate` for WordPress brings you a Plugin Boilerplate in the popular MVC-Pattern. 

Seperate you businesslogic from you view and split your templates in small components for optimal reusing.

You can directly start to build your own WordPress Plugin with pre-configurated `sass` and `javascript` build-processes.

## Pre-Requirements

Make sure you have installed `Node.js` and `Gulp` globaly.

You need to have the ClassLoader included in your WordPress Installation.

## Installation

Open the Repository directorie and run

```
npm install
```

to install all requirements from the `package.json` file.

## Configuration

To config your own plugin open `./config/config.build.js` and adjust the `plainPrefix` and `pluginName` property.

Please let the `plainPrefix` without any hyphens or others similars.

Please write your `pluginName` in camelCase style to load the classes within the required ClassLoader correctly.

## BuildProcess

To Create your own WordPress Plugin with MVC-Pattern just run after configurations

```
gulp build-plugin
```

It creates a folder with your Plugin name with all requirements an prepared `sass` and `javascript` build-processes.

## Usage

If the build-process finished successfully, you can copy your new created plugin folder into your `WordPress Plugin directory`.

Now activate your Plugin in the WordPress Backend.

You have 2 automatically created entry points as shortcodes

``` [wpPluginNameEntry] ```

and 

``` [wpPluginNameAdminEntry] ```
