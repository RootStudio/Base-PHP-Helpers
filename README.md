# Base-PHP-Helpers

PHP Helper functions for building sites using Base 5

## Installation

Add the following to your `composer.json` file:

```json
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:RootStudio/Base-PHP-Helpers.git"
    }
],
"require": {
  "rootstudio/base-php-helpers": "^1.1",
}
```

## Features

This package includes PHP functions that streamline building sites using the Base 5 boilerplate.

* `mix()` and `public_path()` functions for asset management
* API compatibility with `perch_layout_*` functions
* Additional PHP libraries for working with Strings and Dates.

### Mix

The mix helper should be used to call in static assets compiled with Laravel Mix. For example:

```html+php
<?php require 'vendor/autoload.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Base NG</title>

    <link rel="stylesheet" href="<?php echo mix('assets/css/global.css'); ?>">
</head>

<body>
    <!-- Page Content... -->

    <script src="<?php echo mix('assets/js/manifest.js'); ?>"></script>
    <script src="<?php echo mix('assets/js/vendor.js'); ?>"></script>
    <script src="<?php echo mix('assets/js/app.js'); ?>"></script>
</body>
</html>
```

### Layouts

Whether a static site or one that will be integrated with Perch, it is good to seperate certain re-usable files into partials:

```php
<?php base_layout('global/header', ['class' => 'home']); ?>
```

The function accepts 3 parameters:

* The path to the file (relative to the `layouts` directory)
* An array of variables to passed through
* Optionally return rather than echo the template

Inside the layout file variables can be echoed or returned using

```php
<?php base_layout_var('class'); ?>
```
Variables can also be checked with:

```
<?php base_layout_has('class'); ?>
```

**Perch**

Migrating a static site to Perch is simply a matter of replacing `base_` with `perch_` on each of the above functions. This is deliberate to reduce the time spent converting files to use Perch's template system.