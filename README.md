# BaseLayout-PHP-Helpers

PHP Helper functions for building sites using Base 5.

## Installation

Add the following to your `composer.json` file:

```json
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:RootStudio/BaseLayout-PHP-Helpers.git"
    }
],
"require": {
  "rootstudio/base-php-helpers": "^2.1",
}
```

The v2.x version of the library requires PHP 7 or higher. For versions below this change the require statement to:

```json
"require": {
  "rootstudio/base-php-helpers": "^1.2",
}
```

## Settings
If you need to modify the public and layout directories you can set the following constants early in your code:

```php
define('BASE_PUBLIC_DIR', 'public');
define('BASE_LAYOUT_DIR', 'layouts');
```

## Features

This package includes PHP functions that streamline building sites using the BaseLayout 5 boilerplate.

* `base_asset()` and `base_public_path()` functions for asset management
* API compatibility with `perch_layout_*` functions
* Additional PHP libraries for working with Strings and Dates.

### Assets

The mix helper should be used to call in static assets compiled with Laravel Mix. For example:

```html+php
<?php require 'vendor/autoload.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>BaseLayout NG</title>

    <link rel="stylesheet" href="<?php echo base_asset('assets/css/global.css'); ?>">
</head>

<body>
    <!-- Page Content... -->

    <script src="<?php echo base_asset('assets/js/manifest.js'); ?>"></script>
    <script src="<?php echo base_asset('assets/js/vendor.js'); ?>"></script>
    <script src="<?php echo base_asset('assets/js/app.js'); ?>"></script>
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

### Mock Data

The Faker library allows you to generate random content for a wide variety of patterns. For a full list see [the documention](https://github.com/fzaninotto/Faker#formatters).

```php
$faker = base_faker_factory();

echo $faker->email;
```

If you only need a single use you can shorthand the above to:

```php
echo base_faker_factory()->email;
```

### URLs

The fully qualified domain name can be returned using `base_http_host()`. The function will automatically add the correct protocol if SSL is enabled:

```php
<link rel="icon" sizes="152x152" href="<?php echo base_http_host(); ?>/images/meta/touch-icon.png">
```

**Perch**

Migrating a static site to Perch is simply a matter of replacing `base_` with `perch_` on each of the above functions. This is deliberate to reduce the time spent converting files to use Perch's template system.

## Included Packages
Included are useful libraries for handling strings and dates:

### Carbon

Date and time manipulations made easy:

```php
use Carbon\Carbon;

Carbon::now()->addMonths(2)->format('d/m/Y');
```

View Documentation: [http://carbon.nesbot.com/docs/](http://carbon.nesbot.com/docs/)

### Stringy

Advanced string manipulation and utilities. Makes checking for strings and modifying format very simple:

```php
use Stringy\Stringy as Stringy;

if(Stringy::create('Tom Bradley ordered 6 Products')->contains('Tom Bradley')) {
	echo 'Alert Lydia!';
}
```

View Documentation: [https://github.com/danielstjules/Stringy](https://github.com/danielstjules/Stringy)

### Faker

Generates mock content for for a wide variety of patterns including names, addresses, emails, urls and even images.

```php
$faker = Faker\Factory::create();
echo $faker->sentence;
```
View Documentation: [https://github.com/fzaninotto/Faker](https://github.com/fzaninotto/Faker)
