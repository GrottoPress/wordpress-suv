# WordPress SUV

**SUV** is our own architecture for building WordPress themes and plugins at [*GrottoPress*](https://www.grottopress.com). This package is a scaffold for implementing **SUV**.

**SUV** is short for *Setups-Utilities-Views*. It emphasises an object oriented approach to writing WordPress plugins and themes, and provides for a cleaner, more organised code base.

SUV employs object composition extensively, and makes full use of the express power of core WordPress' event-driven architecture.

**Setups**: Includes all objects with methods that interact directly with WordPress, usually by means of action and filter hooks.

**Utilities**: Utilities are objects with methods that are needed by setups and views to accomplish their goals.

**Views**: Views are templates and partials to be loaded by the theme/plugin or WordPress.

## Requirements

- PHP >= 7.0
- [Composer](https://getcomposer.org)

## Code style

Code should comply with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/) and [PSR-4](http://www.php-fig.org/psr/psr-4/), at least.

You are strongly encouraged to use strict typing in PHP 7, and specify types for function/method arguments and return values.

As much as possible:

- Aim for immutable objects
- Prefer declarative syntax
- Don't inherit concrete classes
- Avoid static methods
- Do away with *fancy* design patterns

## Usage

**Note:** From here on, *app* refers to your theme or plugin.

### Directory Structure

Set up your own app's directory structure as follows:

```
.
├── app/
│   ├── MyApp/
│   │   ├── Setups/
│   │   ├── Utilities/
│   │   └── Utilities.php
│   ├── helpers.php
│   └── MyApp.php
├── assets/
│   ├── css/
│   └── js/
├── dist/
│   ├── css/
│   └── js/
├── lang/
├── node_modules/
├── partials/
├── templates/
├── tests/
├── vendor/
├── .editorconfig
├── .gitignore
├── CHANGELOG.md
├── codeception.yml
├── composer.json
├── composer.lock
├── <app-bootsrap>.php (functions.php or my-plugin.php)
├── LICENSE
├── package.json
├── package-lock.json
├── postcss.config.js
├── README.md
├── tailwind.config.js
├── tsconfig.json
└── webpack.mix.js
```

Not all directories/files may apply in your case. Remove whichever you do not need, and add whatever you require as necessary. Just keep the general concept in mind.

### Autoloading

Your `composer.json` autoload config:

```json
{


  "autoload": {
    "psr-4": {
      "Vendor\\": "app/"
    },
    "files": [
      "app/helpers.php"
    ]
  }


}
```

### Require SUV

From the root of your app, run:

```bash
composer require grottopress/wordpress-suv
```

## Sample WordPress plugin

Let's write a sample WordPress plugin using SUV, shall we?

```php
// @ wp-content/plugins/my-plugin/app/MyPlugin.php

<?php
declare (strict_types = 1);

namespace Vendor;

use Vendor\MyPlugin\Setups;
use Vendor\MyPlugin\Utilities;
use GrottoPress\WordPress\SUV\AbstractPlugin;

final class MyPlugin extends AbstractPlugin
{
    /**
     * @var Utilities
     */
    private $utilities;

    protected function __construct()
    {
        $this->setups['Footer'] = new Setups\Footer($this);
        // ...
    }

    protected function getUtilities(): Utilities
    {
        return $this->utilities = $this->utilities ?: new Utilities($this);
    }
}
```

```php
// @ wp-content/plugins/my-plugin/app/MyPlugin/Setups/Footer.php

<?php
declare (strict_types = 1);

namespace Vendor\MyPlugin\Setups;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;

final class Footer extends AbstractSetup
{
    public function run()
    {
        \add_action('wp_footer', [$this, 'renderText']);
    }

    /**
     * @action wp_footer
     */
    public function renderText()
    {
        echo '<div class="useless-text">'.
            $this->app->utilities->text->render().
        '</div>';
    }
}
```

You may file utility classes in `app/MyPlugin/Utilities/`. Utility classes do not interact directly with WordPress, but contain functionality that setup classes and views can use to accomplish their goal.

```php
// @ wp-content/plugins/my-plugin/app/MyPlugin/Utilities.php

<?php
declare (strict_types = 1);

namespace Vendor\MyPlugin;

use Vendor\MyPlugin;
use GrottoPress\Getter\GetterTrait;

class Utilities
{
    use GetterTrait;

    /**
     * @var MyPlugin
     */
    private $app;

    /**
     * @var Utilities\Text
     */
    private $text;

    public function __construct(MyPlugin $plugin)
    {
        $this->app = $plugin;
    }

    private function getApp(): MyPlugin
    {
        return $this->app;
    }

    private function getText(): Utilities\Text
    {
        return $this->text = $this->text ?: new Utilities\Text($this);
    }
}
```

```php
// @ wp-content/plugins/my-plugin/app/MyPlugin/Utilities/Text.php

<?php
declare (strict_types = 1);

namespace Vendor\MyPlugin\Utilities;

use Vendor\MyPlugin\Utilities;
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
     * This is obviously a very trivial example. We could
     * have just printed this directly in the footer setup's
     * `renderText()` method.
     *
     * It is done here only for the purpose of demonstration,
     * if you know what I mean.
     */
    public function render(): string
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

use Vendor\MyPlugin;

function MyPlugin(): MyPlugin
{
    return MyPlugin::getInstance();
}
```

Other plugins and themes now have access to the singleton plugin instance, and can remove an action in our plugin thus:

```php
\add_action('init', function () {
    \remove_action('wp_footer', [\MyPlugin()->setups['Footer'], 'renderText']);
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

require __DIR__.'/vendor/autoload.php';

/**
 * Run plugin
 */
\add_action('plugins_loaded', function () {
    \MyPlugin()->run();
}, 0);
```

## Building a plugin?

We created a [WordPress plugin scaffold](https://github.com/GrottoPress/wordpress-plugin) that uses SUV. It sets up the most common stuff for you to dive straight into code.

You should [check it out](https://github.com/GrottoPress/wordpress-plugin) &raquo;

## Building a theme?

If you're looking to build a theme using **SUV**, you should check out [Jentil](https://www.grottopress.com/jentil/).

Jentil is a framework for rapid WordPress theme development, built using the **SUV** architecture.

It comes with numerous features, and includes a loader that loads templates (eg: `page.php`, `index.php`, `single.php` etc) **only** from the `app/templates` directory, and partials (eg: `header.php`, `footer.php`, `sidebar.php`) from the `app/partials` directory.

[Check it out](https://www.grottopress.com/jentil/) &raquo;

## Development

Run tests with `composer run test`.

## Contributing

1. [Fork it](https://github.com/GrottoPress/wordpress-suv/fork)
1. Switch to the `master` branch: `git checkout master`
1. Create your feature branch: `git checkout -b my-new-feature`
1. Make your changes, updating changelog and documentation as appropriate.
1. Commit your changes: `git commit`
1. Push to the branch: `git push origin my-new-feature`
1. Submit a new *Pull Request* against the `GrottoPress:master` branch.
