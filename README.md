# Module: composer-manager
This module helps you provide shared composer vendors across multiple modules.
To use this System you need to install it **as a Plugin** and check if other modules, which use 3rd party
dependencies (composer packages), have the composer file in a directory which matches one of the following
locations and **do not** include any `vendor/autoload.php` files. This module takes care of all
includes

- **Plugin Locations**:
    - `plugins/valkyrie-*/composer.json`
    - `plugins/core-*/composer.json`
    - `plugins/*/valkyrie.composer.json`
    - `plugins/*/wp-core.composer.json`
- **Theme Locations**:
    - `themes/*/modules/*/composer.json`
    - `themes/*/valkyrie/*/composer.json`
    - `themes/*/wp-core/*/composer.json`
    
More Paths can be added in the `composer.json` file. \
For more options please visit [wikimedia/composer-merge-plugin](https://github.com/wikimedia/composer-merge-plugin).

## Merging dependencies
After you installed a new module which uses a composer file. Make sure its `composer.json` matches one
of the paths above and use `composer update --lock` to update the composer-managers vendor files.

After the commands completion, all your vendors should be available in your new package

## Module-Dependency
Because your new Modules are dependent on the composer-manager. Don't forget to add `_COMPOSER_` as a dependency
to your module. This will ensure, that all vendors are loaded, the moment the `init` method is being called.