# WordPress Compatibility Tool

> Short description here.

[![Support Level](https://img.shields.io/badge/support-beta-blueviolet.svg)](#support-level) [![MIT License](https://img.shields.io/github/license/10up/wp-compat-validation-tool.svg)](https://github.com/10up/wp-compat-validation-tool/blob/trunk/LICENSE.md)

## Overview

Long description here.

## Usage

In your project's `composer.json`, add the following:

```json
{
    "require": {
        "siddharth/wp-compat-validation-tools": "dev-master",
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/Sidsector9/wp-compat-validation-tools.git"
        }
    ],
    "scripts": {
        "post-install-cmd": [
            "./vendor/siddharth/wp-compat-validation-tools/replace-namespace.sh <New_Name_Space>",
            "composer dump-autoload"
        ],
        "post-update-cmd": [
            "./vendor/siddharth/wp-compat-validation-tools/replace-namespace.sh <New_Name_Space>",
            "composer dump-autoload"
        ]
    }
}
```

Replace `<New_Name_Space>` with a unique namespace specific to your project.
The `WP_Compat_Validation_Tools` will be replaced by `<New_Name_Space>` to avoid namespace collisions in case multiple plugins use this package as their dependency.

## Support Level

**Beta:** This project is quite new and we're not sure what our ongoing support level for this will be. Bug reports, feature requests, questions, and pull requests are welcome. If you like this project please let us know, but be cautious using this in a Production environment!

## Changelog

A complete listing of all notable changes to 10up Sitemaps is documented in [CHANGELOG.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CHANGELOG.md).

## Contributing

Please read [CODE_OF_CONDUCT.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CODE_OF_CONDUCT.md) for details on our code of conduct, [CONTRIBUTING.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CONTRIBUTING.md) for details on the process for submitting pull requests to us, and [CREDITS.md](https://github.com/10up/wp-compat-validation-tool/blob/develop/CREDITS.md) for a listing of maintainers of, contributors to, and libraries used by 10up Sitemaps.

## Like what you see?

<a href="http://10up.com/contact/"><img src="https://10up.com/uploads/2016/10/10up-Github-Banner.png" width="850" alt="Work with us at 10up"></a>
