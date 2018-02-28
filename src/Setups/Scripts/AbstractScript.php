<?php

/**
 * Abstract Script
 *
 * @package GrottoPress\WordPress\SUV\Setups\Scripts
 * @since 0.3.0
 *
 * @author GrottoPress <info@grottopress.com>
 * @author N Atta Kusi Adusei
 */

declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Scripts;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\Setups\EnqueueTrait;

/**
 * Abstract Script
 *
 * @since 0.3.0
 */
abstract class AbstractScript extends AbstractSetup
{
    use EnqueueTrait;
}
