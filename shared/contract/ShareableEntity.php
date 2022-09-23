<?php

namespace Shared\Contract;

use Shared\Enum\DiscriminatorContext;

abstract class ShareableEntity
{
    protected DiscriminatorContext $discriminator;
}