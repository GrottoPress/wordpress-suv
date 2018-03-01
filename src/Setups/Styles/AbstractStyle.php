<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Styles;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\Setups\EnqueueTrait;

abstract class AbstractStyle extends AbstractSetup
{
    use EnqueueTrait;
}
