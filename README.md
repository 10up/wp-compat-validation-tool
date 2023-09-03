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
