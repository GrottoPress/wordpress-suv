# WordPress SUV

**SUV** is our own architecture for building WordPress themes and plugins at [*GrottoPress*](https://www.grottopress.com).

This package is a scaffold for implementing **SUV**.

**SUV** is short for *Setups-Utilities-Views*, which... well... organises code into three groups: Setups, Utilities, and Views.

It emphasises an object oriented approach to writing WordPress plugins and themes, and provides for a cleaner, more organised code base.

**Setups**: Includes all classes that modify the page life cycle in any way, by means of action and filter hooks.

**Utilities**: Utilities are classes that help the setups fulfill their mission.

**Views**: Views are templates and partials to be loaded by the theme/plugin or WordPress.

## Requirements

- PHP >= 7.0
- [Composer](https://getcomposer.org)

## Recommendations

- [NPM](https://www.npmjs.com/) for managing asset dependencies
- [Gulp](https://gulpjs.com/) for building assets
- [Sass/SCSS](http://sass-lang.com/) for writing and compiling CSS
- [Typescript](http://www.typescriptlang.org/) for JS.
- [WP browser](https://packagist.org/packages/lucatume/wp-browser) and [function mocker](https://packagist.org/packages/lucatume/function-mocker) for tests
- [Travis CI](https://travis-ci.org/) for CI/CD

## Code style

Code should comply with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/) and [PSR-4](http://www.php-fig.org/psr/psr-4/), at least.

You are strongly encouraged to use strict typing in PHP 7, and specify types for function/method arguments and return values.

## Usage

**Note:** From here on, *app* refers to your theme or plugin.

### Directory Structure

Set up your own app's directory structure as follows:

```
.
├── app/
│   ├── libraries/
│   │   ├── MyApp.php
│   │   ├── Setups/
│   │   └── Utilities/
│   ├── partials/
│   ├── templates/
│   └── helpers.php
├── assets/
│   ├── scritps/
│   ├── styles/
│   └── vendor/ (copy production assets from node_modules/ here)
├── bin/
├── dist/
│   ├── scritps/
│   └── styles/
├── languages/
├── node_modules/
├── tests/
├── vendor/
├── .gitignore
├── .travis.yml
├── <app-bootsrap>.php (functions.php or my-plugin.php)
├── CHANGELOG.md
├── composer.json
├── composer.lock
├── gulpfile.js
├── LICENSE.md
├── package.json
├── package-lock.json
└── README.md
```

Not all directories/files may apply in your case. Remove whichever you do not need, and add whatever you require as necessary. Just keep the general concept in mind.

### Autoloading

Your `composer.json` autoload config:

```json
"autoload": {
    "psr-4": {
        "Vendor\\MyApp\\": "app/libraries/"
    },
    "files": [
        "app/helpers.php"
    ]
},
```

### Require SUV

From the root of your app, run:

```bash
composer require grottopress/wordpress-suv
```

## Sample WordPress plugin

Let's write a sample WordPress plugin, shall we?

```php
// @ wp-content/plugins/my-plugin/app/libraries/MyPlugin.php

<?php
declare (strict_types = 1);

namespace Vendor\MyPlugin;

!\defined('WPINC') && die;

use Vendor\MyPlugin\Utilities\Utilities;
use GrottoPress\WordPress\SUV\AbstractPlugin;

final class MyPlugin extends AbstractPlugin
{
    /**
     * @var Utilities
     */
    private $utilities = null;

    protected function __construct()
    {
        $this->setups['Footer'] = new Setups\Footer($this);
        // ...
    }

    protected function getUtilities(): Utilities
    {
        if (null === $this->utilities) {
            $this->utilities = new Utilities($this);
        }

        return $this->utilities;
    }
}

```

```php
// @ wp-content/plugins/my-plugin/app/libraries/Setups/Footer.php

<?php 
declare (strict_types = 1);

namespace Vendor\MyPlugin\Setups;

!\defined('WPINC') && die;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

final class Footer extends AbstractSetup
{
    public function run()
    {
        \add_action('wp_footer', [$this, 'renderUselessText']);
    }

    /**
     * @action wp_footer
     */
    public function renderUselessText()
    {
        echo '<div class="useless-text">'.
            $this->app->utilities->text->uselessText().
        '</div>';
    }
}
```

You may file utility classes in `app/libraries/Utilities/`. Utility classes do not contain calls to `\add_action()`, `\remove_action()`, `\add_filter()` or `\remove_filter()`, but contain functionality that setup classes can use to fulfill their mission.

```php
// @ wp-content/plugins/my-plugin/app/libraries/Utilities/Utilities.php

<?php 
declare (strict_types = 1);

namespace Vendor\MyPlugin\Utilities;

!\defined('WPINC') && die;

use Vendor\MyPlugin\MyPlugin;
use GrottoPress\Getter\GetterTrait;

class Utilities
{
    use GetterTrait;

    /**
     * @var MyPlugin
     */
    private $app;
    
    /**
     * @var Text
     */
    private $text = null;

    public function __construct(MyPlugin $plugin)
    {
        $this->app = $plugin;
    }

    private function getApp(): MyPlugin
    {
        return $this->app;
    }

    private function getText(): Text
    {
        if (null === $this->text) {
            $this->text = new Text($this);
        }

        return $this->text;
    }
}
```

```php
// @ wp-content/plugins/my-plugin/app/libraries/Utilities/Text.php

<?php 
declare (strict_types = 1);

namespace Vendor\MyPlugin\Utilities;

!\defined('WPINC') && die;

use GrottoPress\Getter\GetterTrait;

class Text
{
    use GetterTrait;

    /**
     * @var Utilities
     */
    private $utilities;

    public function __construct(Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    /**
     * Useless text
     *
     * This is obviously a very trivial example. We could
     * have just printed this directly in the footer setup's
     * `renderUselessText()` method.
     *
     * It is done here only for the purpose of demonstration,
     * if you know what I mean.
     */
    public function uselessText(): string
    {
        return \esc_html__('Useless text', 'my-plugin');
    }
}
```

Since our plugin `extends` **SUV**'s `AbstractPlugin`, it is essentially a singleton. The entire plugin (with all objects) can be retrieved with a call to `Vendor\MyPlugin\MyPlugin::getInstance()`

Let's create a helper to do this in `app/helpers.php`.

```php
// @ wp-content/plugins/my-plugin/app/helpers.php

<?php
declare (strict_types = 1);

!\defined('WPINC') && die;

use Vendor\MyPlugin\MyPlugin;

function MyPlugin(): MyPlugin
{
    return MyPlugin::getInstance();
}
```

Other plugins and themes now have access to the singleton plugin instance, and can remove an action in our plugin thus:

```php
\add_action('init', function () {
    \remove_action('wp_footer', [\MyPlugin()->setups['Footer'], 'renderUselessText']);
});
```

Now, to conclude with our plugin's bootstrap:

```php
// @ wp-content/plugins/my-plugin/my-plugin.php

<?php

/**
 * @wordpress-plugin
 * Plugin Name: My Plugin
 * Plugin URI: https://www.grottopress.com
 * Description: My awesome plugin
 * Version: 0.1.0
 * Author: GrottoPress
 * Author URI: https://www.grottopress.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: my-plugin
 * Domain Path: /languages
 */

declare (strict_types = 1);

!\defined('WPINC') && die;

require __DIR__.'/vendor/autoload.php';

/**
 * Run plugin
 */
\add_action('plugins_loaded', function () {
    \MyPlugin()->run();
}, 0);
```

## Building a theme?

If you're looking to build a theme using **SUV**, you should check out [Jentil](https://jentil.grottopress.com).

Jentil is a framework for rapid WordPress theme development, built using the **SUV** architecture.

It comes with numerous features, and includes a loader that loads templates (eg: `page.php`, `index.php`, `single.php` etc) **only** from the `app/templates` directory, and partials (eg: `header.php`, `footer.php`, `sidebar.php`) from the `app/partials` directory.

[Check it out](https://jentil.grottopress.com)...
