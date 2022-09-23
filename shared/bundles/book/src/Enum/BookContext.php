<?php

namespace Shared\Bundles\Book\Enum;

enum BookContext: string
{
    case API = 'book-api';
    case ADMIN = 'book-admin';
}