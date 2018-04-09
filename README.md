# WordPress Skeleton Plugin in MVC-Pattern

## Setup
- [1.0] **Rename Directory**
    - Rename the directory **wp-plugin-skeleton** into **your-plugin**

- [2.0] **Rename Pluginfile**
    - Rename the Pluginfile in your the root Plugin directory.
    - **wp-plugin-skeleton.php** into **your-plugin.php**

- [3.0] **Skeleton.php**
    - Go to **./src/** and rename **Skeleton.php** into **YourPlugin.php** with capital first letter in CamelCase Style
    - Open the File and rename the class name **Skeleton** into **YourPlugin**
    - Rename **instance of Skeleton** in line 32 into **instance of YourPlugin**

- [4.0] **Define your Plugin-Prefix**
    - Define your Plugin-Prefix and search in your plugin folder with your IDE for **wpps** and replace it with your prefix (i.e. **yp** for your-plugin). Make sure you search case sensitive to find the right prefixes.
    - Replace all const's. Search in your plugin folder with your IDE for **WPPS** and replace it with your prefix (i.e. **YP** for your plugin). Make sure you search case sensitive and all uppercase to only find the consts

- [5.0] **Last look into you Pluginfile**
    - Open your root Pluginfile and make sure the namespaces and the **Skeleton** class is renamed into your custom settings
