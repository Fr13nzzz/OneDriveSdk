<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum;

enum EndPoint: string
{
    case AUTHORIZE = '/authorize';
    case TOKEN = '/token';
}
