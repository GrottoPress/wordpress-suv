<?php
declare (strict_types = 1);

namespace GrottoPress\WordPress\SUV\Setups\Scripts;

use GrottoPress\WordPress\SUV\Setups\AbstractSetup;
use GrottoPress\WordPress\SUV\Setups\EnqueueTrait;

abstract class AbstractScript extends AbstractSetup
{
    use EnqueueTrait;
}
