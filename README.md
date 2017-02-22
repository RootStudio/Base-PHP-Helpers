# Base-Mix-Helper

Mix standalone function for versioned assets outside of Laravel.

## Installation

Add the following to your `composer.json` file:

```json
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:RootStudio/Base-Mix-Helper.git"
    }
],
"require": {
  "rootstudio/base-mix-helper": "^1.0",
}
```

## Usage

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
