<?php

namespace Shared\Contract;

use Shared\Contract\Enum\DiscriminatorContext;

abstract class ShareableEntity
{
    protected DiscriminatorContext $discriminator;
}