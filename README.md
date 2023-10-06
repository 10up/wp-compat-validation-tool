# WordPress Compatibility Tool

> Perform PHP and WP version compatibility checks in your plugin.

[![Support Level](https://img.shields.io/badge/support-beta-blueviolet.svg)](#support-level) [![MIT License](https://img.shields.io/github/license/10up/wp-compat-validation-tool.svg)](https://github.com/10up/wp-compat-validation-tool/blob/trunk/LICENSE.md)

## Overview

This library provides API methods to perform version validation checks in WordPress plugins.
Most helpful in situation where the plugin should gracefully exit on activation when system requirements aren't met.

## Setup

In your project's `composer.json`, add the following:

```json
{
    "require": {
        "10up/wp-compat-validation-tool": "dev-trunk"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/10up/wp-compat-validation-tool.git"
        }
    ],
    "scripts": {
        "post-install-cmd": [
            "./10up-lib/wp-compat-validation-tool/replace-namespace.sh <New_Name_Space>"
        ],
        "post-update-cmd": [
            "./10up-lib/wp-compat-validation-tool/replace-namespace.sh <New_Name_Space>"
        ]
    },
    "extra": {
        "installer-paths": {
            "./{$name}/": ["10up/wp-compat-validation-tool"]
        }
    }
}
```

Replace `<New_Name_Space>` with a unique namespace specific to your project.
The `WP_Compat_Validation_Tools` namespace will be replaced by `<New_Name_Space>` to avoid namespace collisions in situations where multiple plugins use this package as their dependencies.

## Usage

```php
if ( ! is_readable( __DIR__ . '/10up-lib/wp-compat-validation-tool/src/Validator.php' ) ) {
    return;
}

require_once '10up-lib/wp-compat-validation-tool/src/Validator.php';

$compat_checker = new \New_Name_Space\Validator();
$compat_checker
    ->set_plugin_name( '<Your plugin name>' )
    ->set_php_min_required_version( '7.4' );

if ( ! $compat_checker->is_plugin_compatible() ) {
    return;
}
```

The `Validator` class should be instantiated immediately before loading the `vendor/autoload.php` class, and the validation checks should be done before loading or instantiating any other composer dependency.

## Support Level

**Beta:** This project is quite new and we're not sure what our ongoing support level for this will be. Bug reports, feature requests, questions, and pull requests are welcome. If you like this project please let us know, but be cautious using this in a Production environment!

## Changelog

A complete listing of all notable changes to 10up Sitemaps is documented in [CHANGELOG.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CHANGELOG.md).

## Contributing

Please read [CODE_OF_CONDUCT.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CODE_OF_CONDUCT.md) for details on our code of conduct, [CONTRIBUTING.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CONTRIBUTING.md) for details on the process for submitting pull requests to us, and [CREDITS.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CREDITS.md) for a listing of maintainers of, contributors to, and libraries used by 10up Sitemaps.

## Like what you see?

<a href="http://10up.com/contact/"><img src="https://10up.com/uploads/2016/10/10up-Github-Banner.png" width="850" alt="Work with us at 10up"></a>
