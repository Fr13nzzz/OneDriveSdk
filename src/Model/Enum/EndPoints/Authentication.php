<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum Authentication: string
{
    case AUTHORIZE = '/authorize';
    case TOKEN = '/token';
}
