<?php

namespace Shared\Enum;

enum DiscriminatorContext: string
{
    case BASE = 'base';
    case API = 'api';
    case ADMIN = 'admin';
}