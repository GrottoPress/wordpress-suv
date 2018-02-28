<?php

/**
 * Abstract Stylesheet
 *
 * @package GrottoPress\WordPress\SUV\Setups\Styles
 * @since 0.3.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Styles;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\Setups\EnqueueTrait;

/**
 * Abstract Stylesheet
 *
 * @since 0.3.0
 */
abstract class AbstractStyle extends AbstractSetup
{
    use EnqueueTrait;
}
